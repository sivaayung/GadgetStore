
@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-heading', 'Edit Produk')

@section('content')

<style>
    .edit-product-wrapper {
        padding-bottom: 30px;
    }

    .edit-product-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid #edf0f7;
        box-shadow: 0 8px 30px rgba(31, 55, 100, .07);
        overflow: hidden;
    }

    .edit-product-header {
        background: linear-gradient(135deg, #3268e8, #695cf0);
        color: white;
        padding: 25px 30px;
    }

    .edit-product-header h4 {
        font-weight: 800;
        margin-bottom: 6px;
    }

    .edit-product-header p {
        margin: 0;
        opacity: .85;
    }

    .edit-product-body {
        padding: 30px;
    }

    .edit-product-body label {
        font-weight: 700;
        color: #34415e;
        margin-bottom: 9px;
    }

    .edit-product-body .form-control,
    .edit-product-body .form-select {
        border-radius: 10px;
        border: 1px solid #dfe5f1;
        padding: 11px 14px;
        min-height: 45px;
    }

    .edit-product-body .form-control:focus {
        border-color: #5579ed;
        box-shadow: 0 0 0 3px rgba(85, 121, 237, .12);
    }

    .btn-save-product {
        background: linear-gradient(135deg, #3268e8, #695cf0);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
    }

    .btn-save-product:hover {
        color: white;
        opacity: .9;
        transform: translateY(-1px);
    }

    .btn-cancel-product {
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
    }
</style>

<div class="edit-product-wrapper">

    <div class="edit-product-card">

        <div class="edit-product-header">
            <h4><i class="fas fa-edit mr-2"></i> Edit Data Produk</h4>
            <p>Perbarui informasi produk Gadget Store dengan mudah.</p>
        </div>

        <div class="edit-product-body">

            <form method="POST"
                action="{{ route('products.update', $product) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('products._form')

                <div class="d-flex flex-wrap mt-4">
                    <button type="submit" class="btn btn-save-product mr-2">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('products.index') }}"
                        class="btn btn-secondary btn-cancel-product">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
