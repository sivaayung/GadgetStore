@extends('layouts.app')

@section('title', 'Produk')
@section('page-heading', 'Data Produk')

@section('content')

<style>
    .product-wrapper {
        color: #26334d;
    }

    .product-card {
        background: #fff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,.05);
        padding: 22px;
    }

    .product-title {
        font-weight: 700;
        color: #26334d;
    }

    .btn-add {
        background: #4e73df;
        color: white;
        border-radius: 8px;
        padding: 10px 17px;
        border: none;
    }

    .btn-add:hover {
        background: #375ac2;
        color: white;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px 13px;
        border-color: #dce2ed;
    }

    .table thead th {
        background: #f5f7fc;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        padding: 16px;
        white-space: nowrap;
        border-bottom: 1px solid #e5eaf2;
    }

    .table tbody td {
        padding: 15px 16px;
        vertical-align: middle;
        border-color: #edf0f5;
        font-size: 14px;
    }

    .table tbody tr:hover {
        background: #f8faff;
    }

    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid #e5eaf2;
    }

    .no-img {
        width: 55px;
        height: 55px;
        border-radius: 9px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .code-label {
        background: #eaf0ff;
        color: #4e73df;
        padding: 7px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-label {
        background: #dcfce7;
        color: #15803d;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .stock-low {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-edit {
        background: #f6c23e;
        color: white;
        border-radius: 6px;
        padding: 7px 12px;
        text-decoration: none;
        border: none;
        font-size: 13px;
    }

    .btn-delete {
        background: #e74a3b;
        color: white;
        border-radius: 6px;
        padding: 7px 12px;
        border: none;
        font-size: 13px;
    }

    .btn-edit:hover {
        background: #dda920;
        color: white;
    }

    .btn-delete:hover {
        background: #c93629;
    }

    .action-group {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .pagination {
        justify-content: end;
        margin-top: 18px;
    }
</style>

<div class="product-wrapper">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>
            <h3 class="product-title mb-1">Data Produk</h3>
            <p class="text-secondary mb-0">
                Kelola data dan persediaan produk Gadget Store.
            </p>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Produk
        </a>

    </div>

    {{-- CARD PRODUK --}}
    <div class="product-card">

        {{-- PENCARIAN --}}
        <form method="GET" class="row g-3 mb-4">

            <div class="col-md-5">
                <input
                    name="q"
                    value="{{ request('q') }}"
                    class="form-control"
                    placeholder="Cari kode, nama, merek..."
                >
            </div>

            <div class="col-md-4">
                <select name="category_id" class="form-select">

                    <option value="">Semua kategori</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(request('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">

                <button type="submit" class="btn btn-outline-primary flex-fill">
                    <i class="bi bi-search me-1"></i>
                    Cari / Filter
                </button>

                <a href="{{ route('products.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>

            </div>

        </form>

        {{-- TABEL PRODUK --}}
        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            {{-- GAMBAR --}}
                            <td>
                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-img"
                                    >

                                @else

                                    <div class="no-img">
                                        No Img
                                    </div>

                                @endif
                            </td>

                            {{-- KODE --}}
                            <td>
                                <span class="code-label">
                                    {{ $product->product_code }}
                                </span>
                            </td>

                            {{-- NAMA --}}
                            <td class="fw-semibold">
                                {{ $product->name }}
                            </td>

                            {{-- KATEGORI --}}
                            <td>
                                {{ $product->category?->name ?? '-' }}
                            </td>

                            {{-- MEREK --}}
                            <td>
                                {{ $product->brand }}
                            </td>

                            {{-- HARGA --}}
                            <td class="fw-semibold">
                                Rp {{ number_format((float)$product->price, 0, ',', '.') }}
                            </td>

                            {{-- STOK --}}
                            <td>
                                <span class="stock-label {{ $product->stock <= 5 ? 'stock-low' : '' }}">
                                    {{ $product->stock }} Unit
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="action-group">

                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="btn-edit"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('products.destroy', $product) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-secondary py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada produk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div>
            {{ $products->appends(request()->query())->links() }}
        </div>

    </div>

</div>

@endsection
