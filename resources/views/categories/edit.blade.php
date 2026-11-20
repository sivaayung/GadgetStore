
@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-heading', 'Edit Kategori')

@section('content')

<style>
    .edit-category-wrapper {
        padding-bottom: 30px;
    }

    .edit-category-card {
        background: #fff;
        border: 1px solid #edf0f7;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(31, 55, 100, .07);
        overflow: hidden;
    }

    .edit-category-header {
        background: linear-gradient(135deg, #3268e8, #695cf0);
        color: white;
        padding: 25px 30px;
    }

    .edit-category-header h4 {
        font-weight: 800;
        margin-bottom: 6px;
    }

    .edit-category-header p {
        margin: 0;
        opacity: .85;
    }

    .edit-category-body {
        padding: 30px;
    }

    .edit-category-body label {
        font-weight: 700;
        color: #34415e;
        margin-bottom: 9px;
    }

    .edit-category-body .form-control {
        border-radius: 10px;
        border: 1px solid #dfe5f1;
        padding: 12px 14px;
    }

    .edit-category-body .form-control:focus {
        border-color: #5579ed;
        box-shadow: 0 0 0 3px rgba(85, 121, 237, .12);
    }

    .edit-category-body textarea {
        min-height: 130px;
    }

    .btn-save-category {
        background: linear-gradient(135deg, #3268e8, #695cf0);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
    }

    .btn-save-category:hover {
        color: white;
        opacity: .9;
        transform: translateY(-1px);
    }

    .btn-cancel-category {
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
    }
</style>

<div class="edit-category-wrapper">

    <div class="edit-category-card">

        <div class="edit-category-header">
            <h4>
                <i class="fas fa-edit mr-2"></i>
                Edit Data Kategori
            </h4>
            <p>Perbarui nama dan deskripsi kategori produk Gadget Store.</p>
        </div>

        <div class="edit-category-body">

            <form method="POST"
                action="{{ route('categories.update', $category) }}">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Nama kategori</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Masukkan nama kategori"
                        value="{{ old('name', $category->name) }}">

                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Deskripsi</label>

                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="d-flex flex-wrap">
                    <button type="submit" class="btn btn-save-category mr-2">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('categories.index') }}"
                        class="btn btn-secondary btn-cancel-category">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
