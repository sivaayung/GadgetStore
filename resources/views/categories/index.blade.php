@extends('layouts.app')
@section('title','Kategori Produk')
@section('content')
<div class="d-flex justify-content-between mb-3">
 <h3>Kategori Produk</h3>
 <a class="btn btn-primary" href="{{ route('categories.create') }}">Tambah Kategori</a>
</div>
<div class="card"><div class="card-body">
<table class="table">
<thead><tr><th>Nama</th><th>Deskripsi</th><th>Jumlah Produk</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($categories as $category)
<tr>
<td>{{ $category->name }}</td><td>{{ $category->description }}</td>
<td>{{ $category->products_count }}</td>
<td>
<a class="btn btn-sm btn-warning" href="{{ route('categories.edit',$category) }}">Edit</a>
<form class="d-inline" method="POST" action="{{ route('categories.destroy',$category) }}">
@csrf @method('DELETE')
<button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori?')">Hapus</button>
</form>
</td></tr>
@empty
<tr><td colspan="4">Belum ada kategori.</td></tr>
@endforelse
</tbody></table>{{ $categories->links() }}
</div></div>
@endsection