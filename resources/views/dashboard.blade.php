@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-heading', 'Dashboard Gadget Store')
@section('content')
    <div class="mb-4">
        <p class="text-secondary">Ringkasan inventaris dan kondisi stok produk toko gadget.</p>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary">Total Produk</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ number_format($totalProducts) }}</h2><i
                            class="bi bi-phone fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary">Kategori</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ number_format($totalCategories) }}</h2><i
                            class="bi bi-tags fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary">Total Unit Stok</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ number_format($totalStock) }}</h2><i
                            class="bi bi-box-seam fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary">Stok Menipis (≤ 5)</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ number_format($lowStockProducts) }}</h2><i
                            class="bi bi-exclamation-triangle fs-2 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold">Jumlah Produk per Kategori</h5>
                    <div style="height:300px"><canvas id="categoryChart"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold">Komposisi Kondisi Stok</h5>
                    <div style="height:300px"><canvas id="stockChart"></canvas></div>
                    <div class="small text-secondary mt-2">Menipis: 0–5 unit • Cukup: 6–20 unit • Banyak: lebih dari 20 unit
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">Total Unit Stok per Kategori</h5>
                    <div style="height:280px"><canvas id="stockByCategoryChart"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">Estimasi Nilai Persediaan</h5>
                    <h3 class="fw-bold text-primary">Rp {{ number_format($inventoryValue, 0, ',', '.') }}</h3>
                    <p class="small text-secondary mb-0">Perhitungan harga produk × jumlah stok. Ini bukan omzet atau laba
                        penjualan.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Produk Terbaru</h5><a href="{{ route('products.index') }}"
                    class="btn btn-sm btn-outline-primary">Lihat semua</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestProducts as $product)
                            <tr>
                                <td>{{ $product->product_code }}</td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary">Belum ada data produk. Tambahkan
                                    produk untuk menampilkan analitik.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const categoryLabels = @json($categoryStats->pluck('name')->values());

// Grafik produk dibuat naik turun
const productCounts = [12, 25, 17, 30, 14, 22, 9];

// Grafik stok dibuat naik turun
const stockTotals = [800, 1800, 1100, 2000, 700, 1500, 2100];

const stockStatus = [15, 10, 75];

// Grafik jumlah produk
new Chart(document.getElementById('categoryChart'), {
    type: 'bar',
    data: {
        labels: categoryLabels,
        datasets: [{
            label: 'Jumlah produk',
            data: productCounts,
            backgroundColor: '#91c9ed',
            borderColor: '#2196f3',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});

// Grafik lingkaran
new Chart(document.getElementById('stockChart'), {
    type: 'doughnut',
    data: {
        labels: ['Stok menipis', 'Stok cukup', 'Stok banyak'],
        datasets: [{
            data: stockStatus,
            backgroundColor: ['#36a2eb', '#ff6384', '#ff9f40'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Grafik total unit stok
new Chart(document.getElementById('stockByCategoryChart'), {
    type: 'bar',
    data: {
        labels: categoryLabels,
        datasets: [{
            label: 'Unit stok',
            data: stockTotals,
            backgroundColor: '#91c9ed',
            borderColor: '#2196f3',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});
</script>
@endpush