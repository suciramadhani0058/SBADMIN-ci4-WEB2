<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Analitik</h1>
    <a href="/transaksi/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Transaksi Baru
    </a>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 bg-white">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalBarang) ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-primary text-white">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pelanggan Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalPelanggan) ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-success text-white">
                            <i class="fas fa-user-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penjualan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalTransaksi) ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-info text-white">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Item Terjual</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalDetail) ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-danger text-white">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ikhtisar Penjualan (2026)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Peringatan Stok Rendah</h6>
    </div>
    <div class="card-body">
        <p class="small text-muted">Barang-barang berikut memerlukan stok ulang segera.</p>
        <ul class="list-group list-group-flush">
            <?php if (empty($stokRendah)) : ?>
                <li class="list-group-item text-center text-muted">Semua stok tersedia dengan cukup.</li>
            <?php else : ?>
                <?php foreach ($stokRendah as $s) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $s['nama_barang']; ?>
                        <span class="badge <?= ($s['stok'] < 5) ? 'badge-danger' : 'badge-warning'; ?> badge-pill">
                            <?= $s['stok']; ?> pcs
                        </span>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
    </div>
</div>

<style>
    .icon-circle {
        height: 3rem;
        width: 3rem;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data JSON yang dikirim dari Controller
    const dataGrafik = <?= $grafikData ?>; 

    // Konfigurasi Grafik
    const ctx = document.getElementById('myAreaChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Pendapatan",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataGrafik, // Data dinamis dari database
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: { left: 10, right: 25, top: 25, bottom: 0 }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false }
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Format mata uang Rupiah pada sumbu Y
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    titleMarginBottom: 10,
                    titleColor: '#6e707e',
                    titleFont: { size: 14 },
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem) {
                            return 'Total: Rp ' + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>