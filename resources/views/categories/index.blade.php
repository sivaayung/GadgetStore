
@extends('layouts.app')

@section('title', 'Kategori Produk')
@section('page-heading', 'Kategori Produk')

@section('content')

<style>
    .category-wrapper {
        padding: 10px 5px;
    }

    .category-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .category-heading h3 {
        font-size: 26px;
        font-weight: 700;
        color: #344767;
        margin-bottom: 5px;
    }

    .category-heading p {
        color: #8392ab;
        margin: 0;
        font-size: 14px;
    }

    .btn-add-category {
        background: linear-gradient(135deg, #5278e8, #3157c8);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(63, 103, 216, .2);
        transition: .2s;
    }

    .btn-add-category:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(63, 103, 216, .3);
    }

    .category-card {
        background: #fff;
        border: 1px solid #edf0f7;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
    }

    .category-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-card-header h5 {
        font-weight: 700;
        color: #344767;
        margin: 0;
    }

    .category-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .category-table thead th {
        background: #f5f7fc;
        color: #697995;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 16px;
        border: none;
        white-space: nowrap;
    }

    .category-table thead th:first-child {
        border-radius: 9px 0 0 9px;
    }

    .category-table thead th:last-child {
        border-radius: 0 9px 9px 0;
    }

    .category-table tbody td {
        padding: 19px 16px;
        color: #52617a;
        font-size: 14px;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
    }

    .category-table tbody tr:last-child td {
        border-bottom: none;
    }

    .category-table tbody tr:hover {
        background: #f9faff;
    }

    .category-name {
        color: #344767;
        font-weight: 700;
    }

    .product-count {
        display: inline-block;
        background: #eaf0ff;
        color: #4269d5;
        padding: 6px 13px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
    }

    .btn-edit-category,
    .btn-delete-category {
        border: none;
        border-radius: 7px;
        padding: 8px 13px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: .2s;
    }

    .btn-edit-category {
        background: #fff4d8;
        color: #d99a14;
    }

    .btn-edit-category:hover {
        background: #f6c453;
        color: #fff;
    }

    .btn-delete-category {
        background: #ffe8e8;
        color: #e34b4b;
    }

    .btn-delete-category:hover {
        background: #e34b4b;
        color: #fff;
    }

    .category-empty {
        text-align: center;
        padding: 35px !important;
        color: #8392ab !important;
    }

    @media (max-width: 768px) {
        .category-card {
            padding: 15px;
        }

        .category-table {
            min-width: 650px;
        }

        .category-table-wrapper {
            overflow-x: auto;
        }
    }
</style>

<div class="category-wrapper">

    <div class="category-heading">
        <div>
            <h3>Kategori Produk</h3>
            <p>Kelola kategori produk Gadget Store dengan mudah.</p>
        </div>

        <a class="btn-add-category" href="{{ route('categories.create') }}">
            + Tambah Kategori
        </a>
    </div>

    <div class="category-card">

        <div class="category-card-header">
            <h5>Daftar Kategori</h5>
        </div>

        <div class="category-table-wrapper">
            <table class="category-table">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>
                            <span class="category-name">
                                {{ $category->name }}
                            </span>
                        </td>

                        <td>
                            {{ $category->description }}
                        </td>

                        <td>
                            <span class="product-count">
                                {{ $category->products_count }} Produk
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-2">

                                <a class="btn-edit-category"
                                   href="{{ route('categories.edit', $category) }}">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('categories.destroy', $category) }}"
                                      onsubmit="return confirm('Hapus kategori?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete-category">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="category-empty">
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>

    </div>
</div>

@endsection
