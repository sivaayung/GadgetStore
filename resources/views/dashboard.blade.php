@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard Gadget Store')

@section('content')

<style>
    .dashboard-wrapper {
        color: #26334d;
    }

    .welcome-card {
        background: linear-gradient(120deg, #2563eb, #6366f1);
        color: white;
        border-radius: 18px;
        padding: 28px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.10);
        right: -35px;
        top: -65px;
    }

    .welcome-card h3 {
        font-weight: 700;
    }

    .stat-card {
        position: relative;
        border: 1px solid #edf1f8;
        border-radius: 20px;
        transition: transform .25s ease, box-shadow .25s ease;
        height: 100%;
        min-height: 158px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(31, 55, 100, .07);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        width: 115px;
        height: 115px;
        border-radius: 50%;
        right: -38px;
        bottom: -52px;
        opacity: .10;
        pointer-events: none;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(31, 55, 100, .13);
    }

    .stat-card .card-body {
        position: relative;
        z-index: 1;
        padding: 22px !important;
    }

    .stat-title {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .35px;
        text-transform: uppercase;
    }

    .stat-number {
        font-size: 34px;
        line-height: 1.15;
        font-weight: 800;
        margin: 13px 0 7px;
    }

    .stat-desc {
        font-size: 12px;
        font-weight: 500;
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        box-shadow: 0 7px 15px rgba(0,0,0,.08);
    }

    .stat-blue-card { background: linear-gradient(135deg, #f1f6ff, #e5eeff); }
    .stat-green-card { background: linear-gradient(135deg, #effcf5, #ddf8e9); }
    .stat-purple-card { background: linear-gradient(135deg, #f7f1ff, #eee5ff); }
    .stat-red-card { background: linear-gradient(135deg, #fff4f3, #ffe5e4); }

    .stat-blue-card::after { background: #2563eb; }
    .stat-green-card::after { background: #16a34a; }
    .stat-purple-card::after { background: #9333ea; }
    .stat-red-card::after { background: #dc2626; }

    .icon-blue { background: #2563eb; color: #fff; }
    .icon-green { background: #16a34a; color: #fff; }
    .icon-purple { background: #9333ea; color: #fff; }
    .icon-red { background: #dc2626; color: #fff; }

    .dashboard-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,.045);
        height: 100%;
    }

    .dashboard-card .card-body {
        padding: 22px;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
        border: none;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: #f1f5f9;
    }

    .table tbody tr:hover {
        background: #f8fbff;
    }

    .product-badge {
        background: #eff6ff;
        color: #2563eb;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-badge {
        background: #dcfce7;
        color: #15803d;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-low {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Tampilan tabel produk terbaru */
    .latest-products-card {
        border: 1px solid #edf1f8;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(31, 55, 100, .07);
    }

    .latest-products-card .card-body {
        padding: 26px;
    }

    .latest-products-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 22px;
    }

    .latest-products-title {
        color: #1e293b;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .latest-products-subtitle {
        color: #8491a7;
        font-size: 13px;
    }

    .latest-products-link {
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 700;
        box-shadow: 0 5px 12px rgba(59, 130, 246, .18);
        white-space: nowrap;
    }

    .latest-products-table {
        border-collapse: separate;
        border-spacing: 0 9px;
        margin-bottom: 0;
        min-width: 650px;
    }

    .latest-products-table thead th {
        background: #f3f6fc;
        color: #71809a;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .7px;
        padding: 15px 18px;
        border: 0;
        white-space: nowrap;
    }

    .latest-products-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .latest-products-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .latest-products-table tbody tr {
        background: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .latest-products-table tbody tr:hover {
        background: #fbfdff;
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(31, 55, 100, .07);
    }

    .latest-products-table tbody td {
        padding: 17px 18px;
        border-top: 1px solid #f0f3f8;
        border-bottom: 1px solid #f0f3f8;
        color: #64748b;
        font-size: 13px;
    }

    .latest-products-table tbody td:first-child {
        border-left: 1px solid #f0f3f8;
        border-radius: 12px 0 0 12px;
    }

    .latest-products-table tbody td:last-child {
        border-right: 1px solid #f0f3f8;
        border-radius: 0 12px 12px 0;
    }

    .product-code-badge {
        display: inline-block;
        background: #edf4ff;
        color: #2563eb;
        padding: 7px 12px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .3px;
    }

    .latest-product-name {
        color: #26334d;
        font-weight: 800;
        font-size: 14px;
    }

    .latest-product-category {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        border-radius: 20px;
        padding: 6px 11px;
        font-size: 11px;
        font-weight: 700;
    }

    .latest-product-price {
        color: #2563eb;
        font-weight: 800;
        white-space: nowrap;
    }

    .latest-stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 20px;
        background: #dcfce7;
        color: #15803d;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .latest-stock-badge.stock-low {
        background: #fee2e2;
        color: #dc2626;
    }

    .latest-empty-state {
        padding: 35px 15px !important;
        color: #94a3b8 !important;
    }

    @media(max-width: 576px) {
        .latest-products-card .card-body {
            padding: 18px;
        }

        .latest-products-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .latest-products-link {
            width: 100%;
        }
    }

    .inventory-box {
        background: linear-gradient(135deg, #eff6ff, #f5f3ff);
        border-radius: 14px;
        padding: 22px;
    }

    @media(max-width: 576px) {
        .welcome-card {
            padding: 20px;
        }

        .chart-container {
            height: 260px;
        }
    }
</style>

<div class="dashboard-wrapper">

    {{-- WELCOME --}}
    <div class="welcome-card mb-4">
        <div class="position-relative" style="z-index: 1;">
            <span class="small opacity-75">SELAMAT DATANG DI</span>
            <h3 class="mt-2 mb-2">Gadget Store Dashboard</h3>
            <p class="mb-0 opacity-75">
                Pantau inventaris, stok, dan perkembangan produk toko gadget kamu dalam satu halaman.
            </p>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card stat-card stat-blue-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="stat-title text-primary mb-0">Total Produk</p>
                            <h2 class="stat-number text-dark">
                                {{ number_format($totalProducts) }}
                            </h2>
                            <small class="stat-desc text-secondary">
                                <i class="bi bi-check-circle-fill text-primary mr-1"></i>
                                Produk terdaftar
                            </small>
                        </div>
                        <div class="stat-icon icon-blue">
                            <i class="bi bi-phone"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card stat-card stat-green-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="stat-title text-success mb-0">Total Kategori</p>
                            <h2 class="stat-number text-dark">
                                {{ number_format($totalCategories) }}
                            </h2>
                            <small class="stat-desc text-secondary">
                                <i class="bi bi-tags-fill text-success mr-1"></i>
                                Kategori produk
                            </small>
                        </div>
                        <div class="stat-icon icon-green">
                            <i class="bi bi-tags"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card stat-card stat-purple-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="stat-title mb-0" style="color:#7e22ce;">Total Unit Stok</p>
                            <h2 class="stat-number text-dark">
                                {{ number_format($totalStock) }}
                            </h2>
                            <small class="stat-desc text-secondary">
                                <i class="bi bi-box-seam-fill mr-1" style="color:#9333ea;"></i>
                                Unit tersedia
                            </small>
                        </div>
                        <div class="stat-icon icon-purple">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card stat-card stat-red-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="stat-title text-danger mb-0">Stok Menipis</p>
                            <h2 class="stat-number text-dark">
                                {{ number_format($lowStockProducts) }}
                            </h2>
                            <small class="stat-desc text-danger">
                                <i class="bi bi-exclamation-circle-fill mr-1"></i>
                                Perlu diperhatikan
                            </small>
                        </div>
                        <div class="stat-icon icon-red">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-8">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">Jumlah Produk per Kategori</h5>
                            <small class="text-secondary">
                                Perbandingan jumlah produk setiap kategori
                            </small>
                        </div>
                        <i class="bi bi-bar-chart-line text-primary fs-4"></i>
                    </div>

                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-bold mb-1">Kondisi Stok</h5>
                        <small class="text-secondary">
                            Persentase kondisi persediaan
                        </small>
                    </div>

                    <div class="chart-container">
                        <canvas id="stockChart"></canvas>
                    </div>

                    <div class="small text-secondary mt-2">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Stok menipis</span>
                            <span>0–5 unit</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Stok cukup</span>
                            <span>6–20 unit</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Stok banyak</span>
                            <span>Di atas 20 unit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK STOK DAN NILAI INVENTARIS --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-8">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-bold mb-1">Total Unit Stok per Kategori</h5>
                        <small class="text-secondary">
                            Jumlah persediaan barang berdasarkan kategori
                        </small>
                    </div>

                    <div class="chart-container">
                        <canvas id="stockByCategoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Nilai Persediaan</h5>

                    <div class="inventory-box mb-3">
                        <div class="stat-icon icon-blue mb-3">
                            <i class="bi bi-wallet2"></i>
                        </div>

                        <small class="text-secondary">Estimasi nilai seluruh stok</small>

                        <h3 class="fw-bold text-primary mt-2 mb-0">
                            Rp {{ number_format($inventoryValue, 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary small">Total Produk</span>
                        <strong>{{ number_format($totalProducts) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary small">Total Unit</span>
                        <strong>{{ number_format($totalStock) }}</strong>
                    </div>

                    <hr>

                    <p class="text-secondary small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Nilai dihitung dari harga produk dikalikan jumlah stok, bukan omzet atau laba penjualan.
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- PRODUK TERBARU --}}
    <div class="card dashboard-card latest-products-card">
        <div class="card-body">

            <div class="latest-products-header">
                <div>
                    <h5 class="latest-products-title">Produk Terbaru</h5>
                    <small class="latest-products-subtitle">
                        <i class="bi bi-clock-history mr-1"></i>
                        Daftar produk yang terakhir ditambahkan
                    </small>
                </div>

                <a href="{{ route('products.index') }}"
                   class="btn btn-primary btn-sm latest-products-link">
                    <i class="bi bi-arrow-right-circle mr-1"></i>
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table latest-products-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-upc-scan mr-1"></i> Kode</th>
                            <th><i class="bi bi-phone mr-1"></i> Nama Produk</th>
                            <th><i class="bi bi-tag mr-1"></i> Kategori</th>
                            <th><i class="bi bi-cash-stack mr-1"></i> Harga</th>
                            <th><i class="bi bi-box-seam mr-1"></i> Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestProducts as $product)
                            <tr>
                                <td>
                                    <span class="product-code-badge">
                                        {{ $product->product_code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="latest-product-name">
                                        {{ $product->name }}
                                    </span>
                                </td>

                                <td>
                                    <span class="latest-product-category">
                                        {{ $product->category?->name ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="latest-product-price">
                                        Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="latest-stock-badge {{ $product->stock <= 5 ? 'stock-low' : '' }}">
                                        <i class="bi {{ $product->stock <= 5 ? 'bi-exclamation-circle-fill' : 'bi-check-circle-fill' }}"></i>
                                        {{ $product->stock }} Unit
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center latest-empty-state">
                                    <i class="bi bi-inbox d-block mb-2" style="font-size: 30px;"></i>
                                    Belum ada produk yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Mengambil data dari database
    const categoryLabels = @json($categoryStats->pluck('name')->values());
    const productCounts = @json($categoryStats->pluck('product_count')->values());
    const stockTotals = @json($categoryStats->pluck('stock_total')->values());
    const stockStatus = @json(array_values($stockStatus));

    // Grafik 1: Jumlah produk (garis biru)
    new Chart(document.getElementById('categoryChart'), {
        type: 'line',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Jumlah Produk',
                data: productCounts,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59,130,246,0.15)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 7,
                pointHoverRadius: 10,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#3B82F6',
                pointBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });


// Grafik lingkaran penuh kondisi stok
const stockCanvas = document.getElementById('stockChart');

const percentageLabels = {
    id: 'percentageLabels',

    afterDatasetsDraw(chart) {
        const { ctx } = chart;
        const data = chart.data.datasets[0].data;
        const total = data.reduce((a, b) => a + Number(b), 0);

        if (total === 0) return;

        chart.getDatasetMeta(0).data.forEach((arc, index) => {
            const value = Number(data[index]);
            if (value <= 0) return;

            const percentage = ((value / total) * 100).toFixed(1);

            const position = arc.tooltipPosition();

            ctx.save();
            ctx.fillStyle = '#ffffff';
            ctx.font = 'bold 13px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(percentage + '%', position.x, position.y);
            ctx.restore();
        });
    }
};

new Chart(stockCanvas, {
    type: 'pie',

    data: {
        labels: [
            'Stok Menipis',
            'Stok Cukup',
            'Stok Banyak'
        ],

        datasets: [{
            data: stockStatus,

            backgroundColor: [
                '#EF4444',
                '#F59E0B',
                '#10B981'
            ],

            borderColor: '#ffffff',
            borderWidth: 4,
            hoverOffset: 15
        }]
    },

    plugins: [percentageLabels],

    options: {
        responsive: true,
        maintainAspectRatio: false,

        animation: {
            duration: 1800,
            easing: 'easeOutBounce'
        },

        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    padding: 18,
                    font: {
                        size: 12
                    }
                }
            },

            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' +
                            context.raw + ' produk';
                    }
                }
            }
        }
    }
});


    // Grafik 3: Total unit stok (garis ungu)
    new Chart(document.getElementById('stockByCategoryChart'), {
        type: 'line',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Total Unit Stok',
                data: stockTotals,
                borderColor: '#8B5CF6',
                backgroundColor: 'rgba(139,92,246,0.15)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 7,
                pointHoverRadius: 10,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#8B5CF6',
                pointBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

});
</script>
@endpush
