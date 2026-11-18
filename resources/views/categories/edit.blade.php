@extends('layouts.app')
@section('title','Edit Kategori')
@section('content')
<h3>Edit Kategori</h3>
<form method="POST" action="{{ route('categories.update',$category) }}">
@csrf @method('PUT')
<div class="mb-3"><label>Nama kategori</label>
<input name="name" class="form-control" value="{{ old('name',$category->name) }}">
@error('name')<div class="text-danger">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Deskripsi</label>
<textarea name="description" class="form-control">{{ old('description',$category->description) }}</textarea></div>
<button class="btn btn-primary">Simpan Perubahan</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
