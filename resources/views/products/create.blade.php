
@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-heading', 'Tambah Produk')

@section('content')

<style>
    .create-product-wrapper {
        padding: 10px 5px;
    }

    .create-product-heading {
        margin-bottom: 25px;
    }

    .create-product-heading h3 {
        color: #344767;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .create-product-heading p {
        color: #8392ab;
        font-size: 14px;
        margin: 0;
    }

    .create-product-card {
        background: #fff;
        border: 1px solid #edf0f7;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
    }

    .form-section-title {
        color: #344767;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 22px;
        padding-bottom: 14px;
        border-bottom: 1px solid #edf0f5;
    }

    .create-product-card label {
        color: #52617a;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .create-product-card .form-control,
    .create-product-card .form-select {
        border: 1px solid #dfe5ef;
        border-radius: 9px;
        padding: 11px 14px;
        color: #344767;
        font-size: 14px;
        box-shadow: none;
        transition: .2s;
    }

    .create-product-card .form-control:focus,
    .create-product-card .form-select:focus {
        border-color: #5278e8;
        box-shadow: 0 0 0 3px rgba(82, 120, 232, .12);
    }

    .create-product-card textarea.form-control {
        min-height: 110px;
    }

    .create-product-card input[type="file"].form-control {
        padding: 9px;
    }

    .btn-save-product {
        background: linear-gradient(135deg, #5278e8, #3157c8);
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 12px 23px;
        font-weight: 600;
        transition: .2s;
        box-shadow: 0 4px 12px rgba(63, 103, 216, .2);
    }

    .btn-save-product:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(63, 103, 216, .3);
    }

    @media (max-width: 768px) {
        .create-product-card {
            padding: 18px;
        }
    }
</style>

<div class="create-product-wrapper">

    <div class="create-product-heading">
        <h3>Tambah Produk</h3>
        <p>Tambahkan informasi produk baru ke dalam inventaris Gadget Store.</p>
    </div>

    <div class="create-product-card">

        <div class="form-section-title">
            Informasi Produk
        </div>

        <form method="POST"
              action="{{ route('products.store') }}"
              enctype="multipart/form-data">

            @csrf

            @include('products._form')

            <div class="mt-4">
                <button type="submit" class="btn-save-product">
                    Simpan Produk
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
