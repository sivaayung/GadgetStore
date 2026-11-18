@extends('layouts.app')
@section('content')
<h3>Edit Produk</h3>
<form method="POST" action="{{ route('products.update',$product) }}">
@csrf @method('PUT')
@include('products._form')
<button class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>
@endsection