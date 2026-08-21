<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Penjualan - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body>
    <?= $this->include('components/top_navbar') ?>

    <div class="container-fluid container-max-wide py-3 py-md-4">
        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold tracking-tight text-dark mb-1">
                    <i class="bi bi-clock-history text-primary me-2"></i>Riwayat Penjualan
                </h1>
                <p class="text-muted small mb-0">Daftar lengkap transaksi penjualan yang telah dicatat</p>
            </div>
            <a href="<?= site_url('sales/input') ?>" class="btn btn-primary rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm font-weight-semibold">
                <i class="bi bi-plus-lg"></i>
                <span class="d-none d-sm-inline">Penjualan Baru</span>
            </a>
        </div>

        <?php if (empty($sales)) : ?>
            <div class="card-custom p-5 text-center my-4">
                <div class="bg-blue-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-receipt fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Transaksi Penjualan</h6>
                <p class="text-muted small mb-3">Mulai catat transaksi harian untuk memantau omzet penjualan Anda</p>
                <div>
                    <a href="<?= site_url('sales/input') ?>" class="btn btn-primary btn-sm rounded-pill px-4">
                        <i class="bi bi-plus-lg me-1"></i> Catat Penjualan Pertama
                    </a>
                </div>
            </div>
        <?php else : ?>
            <!-- Laptop / Desktop Table View (d-none d-md-block) -->
            <div class="card-custom d-none d-md-block overflow-hidden mb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr class="text-muted small fw-semibold">
                                <th class="ps-4 py-3">Tanggal</th>
                                <th class="py-3">Produk</th>
                                <th class="py-3">Qty</th>
                                <th class="py-3">Pelanggan & Channel</th>
                                <th class="py-3 text-end">Total Penjualan</th>
                                <th class="pe-4 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales as $sale) : ?>
                                <tr>
                                    <td class="ps-4 py-3 text-secondary small">
                                        <?php
                                        $bulan = [
                                            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                                            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                                            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                        ];
                                        $ts = strtotime($sale['transaction_date']);
                                        echo date('d', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
                                        ?>
                                    </td>
                                    <td class="py-3 fw-bold text-dark">
                                        <?= esc($sale['product_name']) ?>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-light text-dark border font-weight-normal">
                                            <?= number_format((float)$sale['quantity'], 0, ',', '.') ?> unit
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <?php if (!empty($sale['customer_name'])) : ?>
                                                <span class="badge bg-light text-secondary border font-weight-normal">
                                                    <i class="bi bi-person me-1"></i><?= esc($sale['customer_name']) ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (!empty($sale['channel_name'])) : ?>
                                                <span class="badge bg-blue-light font-weight-normal">
                                                    <i class="bi bi-diagram-3 me-1"></i><?= esc($sale['channel_name']) ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (empty($sale['customer_name']) && empty($sale['channel_name'])) : ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="py-3 text-end fw-bold text-primary fs-6">
                                        Rp <?= number_format((float)$sale['amount'], 0, ',', '.') ?>
                                    </td>
                                    <td class="pe-4 py-3 text-end">
                                        <?php if (isset($sale['id'])) : ?>
                                            <a href="<?= site_url('sales/edit/' . $sale['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View (d-md-none) -->
            <div class="d-md-none d-flex flex-column gap-3 mb-4">
                <?php foreach ($sales as $sale) : ?>
                    <div class="card-custom p-3 hover-lift">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                            <div>
                                <span class="text-muted small">
                                    <?php
                                    $ts = strtotime($sale['transaction_date']);
                                    echo date('d', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
                                    ?>
                                </span>
                                <h6 class="fw-bold text-dark mb-0 mt-1">
                                    <?= esc($sale['product_name']) ?>
                                </h6>
                            </div>
                            <div class="text-end">
                                <span class="fw-bold text-primary fs-6">
                                    Rp <?= number_format((float)$sale['amount'], 0, ',', '.') ?>
                                </span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge bg-light text-dark border font-weight-normal">
                                    <?= number_format((float)$sale['quantity'], 0, ',', '.') ?> unit
                                </span>
                                <?php if (!empty($sale['customer_name'])) : ?>
                                    <span class="badge bg-light text-secondary border font-weight-normal">
                                        👤 <?= esc($sale['customer_name']) ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($sale['channel_name'])) : ?>
                                    <span class="badge bg-blue-light font-weight-normal">
                                        📡 <?= esc($sale['channel_name']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if (isset($sale['id'])) : ?>
                                <a href="<?= site_url('sales/edit/' . $sale['id']) ?>" class="btn btn-sm btn-light border rounded-pill px-2-5 py-1 text-muted small">
                                    Edit
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?= $this->include('components/bottom_nav') ?>
</body>
</html>