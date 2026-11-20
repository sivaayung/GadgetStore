
@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-heading', 'Tambah Kategori')

@section('content')

<style>
    .create-category-wrapper {
        padding: 10px 5px;
    }

    .category-heading {
        margin-bottom: 25px;
    }

    .category-heading h3 {
        color: #344767;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .category-heading p {
        color: #8392ab;
        font-size: 14px;
        margin: 0;
    }

    .category-form-card {
        background: #fff;
        border: 1px solid #edf0f7;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
        max-width: 850px;
    }

    .category-form-title {
        color: #344767;
        font-size: 17px;
        font-weight: 700;
        padding-bottom: 16px;
        margin-bottom: 23px;
        border-bottom: 1px solid #edf0f5;
    }

    .category-form-card label {
        color: #52617a;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .category-form-card .form-control {
        border: 1px solid #dfe5ef;
        border-radius: 9px;
        padding: 12px 14px;
        color: #344767;
        font-size: 14px;
        box-shadow: none;
        transition: .2s;
    }

    .category-form-card .form-control:focus {
        border-color: #5278e8;
        box-shadow: 0 0 0 3px rgba(82, 120, 232, .12);
    }

    .category-form-card textarea {
        min-height: 130px;
        resize: vertical;
    }

    .btn-save-category {
        background: linear-gradient(135deg, #5278e8, #3157c8);
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 23px;
        font-weight: 600;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-save-category:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 13px rgba(63, 103, 216, .25);
    }

    .btn-cancel-category {
        background: #eef1f6;
        color: #64748b;
        border: none;
        border-radius: 9px;
        padding: 11px 23px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: .2s;
    }

    .btn-cancel-category:hover {
        background: #dfe5ef;
        color: #344767;
    }

    @media (max-width: 768px) {
        .category-form-card {
            padding: 20px;
        }
    }
</style>

<div class="create-category-wrapper">

    <div class="category-heading">
        <h3>Tambah Kategori</h3>
        <p>Tambahkan kategori baru untuk mengelompokkan produk Gadget Store.</p>
    </div>

    <div class="category-form-card">

        <div class="category-form-title">
            Informasi Kategori
        </div>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-4">
                <label>Nama kategori</label>

                <input
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama kategori"
                >

                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label>Deskripsi</label>

                <textarea
                    name="description"
                    class="form-control"
                    placeholder="Masukkan deskripsi kategori"
                >{{ old('description') }}</textarea>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <button type="submit" class="btn-save-category">
                    Simpan
                </button>

                <a href="{{ route('categories.index') }}" class="btn-cancel-category">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
