@extends('layouts.app')
@section('content')
<h3>Data Produk</h3>
<a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
<form method="GET" class="row g-2 my-3">
<input name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari kode, nama, merek">
<select name="category_id" class="form-select">
<option value="">Semua kategori</option>
@foreach($categories as $category)
<option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
@endforeach
</select>
<button class="btn btn-outline-primary">Cari / Filter</button>
</form>
<table class="table">
<thead><tr><th>Kode</th><th>Produk</th><th>Kategori</th><th>Merek</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($products as $product)
<tr>
<td>{{ $product->product_code }}</td><td>{{ $product->name }}</td>
<td>{{ $product->category->name }}</td><td>{{ $product->brand }}</td>
<td>Rp {{ number_format((float)$product->price,0,',','.') }}</td><td>{{ $product->stock }}</td>
<td><a href="{{ route('products.edit',$product) }}">Edit</a>
<form method="POST" action="{{ route('products.destroy',$product) }}">
@csrf @method('DELETE')<button>Hapus</button></form></td>
</tr>
@empty <tr><td colspan="7">Belum ada produk.</td></tr>
@endforelse
</tbody></table>
{{ $products->links() }}
@endsection