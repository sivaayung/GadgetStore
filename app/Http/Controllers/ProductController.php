<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $products = Product::with('category')
    ->when($request->filled('q'), function ($query) use ($request) {
    $keyword = $request->string('q')->toString();
    $query->where(function ($q) use ($keyword) {
    $q->where('name','like',"%{$keyword}%")
    ->orWhere('product_code','like',"%{$keyword}%")
    ->orWhere('brand','like',"%{$keyword}%");
    });
    })
    ->when($request->filled('category_id'),
    fn ($q) => $q->where('category_id',$request->category_id))
    ->latest()->paginate(10)->withQueryString();
    $categories = Category::orderBy('name')->get();
    return view('products.index', compact('products','categories'));
    }
    public function create()
    {
    $categories = Category::orderBy('name')->get();
    return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
    $validated = $request->validate([
    'category_id' => ['required','exists:categories,id'],
    'product_code' => ['required','string','max:50','unique:products,product_code'],
    'name' => ['required','string','max:150'],
    'brand' => ['nullable','string','max:100'],
    'price' => ['required','numeric','min:0'],
    'stock' => ['required','integer','min:0'],
    'description' => ['nullable','string','max:2000'],
    'image' => ['nullable', 'image', 'mimes:jpg, jpeg, png, webp', 'max:5048'],
    ]);

    if($request->hasFile('image')){
        $validated['image'] = $request->file('image')
        ->store('products', 'public');
    }

    Product::create($validated);
    return redirect()->route('products.index')->with('success','Produk berhasil ditambahkan.');
    }
    public function edit(Product $product)
    {
    $categories = Category::orderBy('name')->get();
    return view('products.edit', compact('product','categories'));
    }
    public function update(Request $request, Product $product)
    {
    $validated = $request->validate([
    'category_id' => ['required','exists:categories,id'],
    'product_code' => ['required','string','max:50',Rule::unique('products','product_code')->ignore($product->id)],
    'name' => ['required','string','max:150'],
    'brand' => ['nullable','string','max:100'],
    'price' => ['required','numeric','min:0'],
    'stock' => ['required','integer','min:0'],
    'description' => ['nullable','string','max:2000'],
    'image' => ['nullable', 'image', 'mimes:jpg, jpeg, png, webp', 'max:5048'],
    ]);

    if($request->hasFile('image')){
        $validated['image'] = $request->file('image')
        ->store('products', 'public');
    }


    $product->update($validated);
    return redirect()->route('products.index')->with('success','Produk berhasil diperbarui.');
    }
    public function destroy(Product $product)
    {
    $product->delete();
    return redirect()->route('products.index')->with('success','Produk berhasil dihapus.');
    }
    }
