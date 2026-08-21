<!DOCTYPE html>
<html lang="id">
<head>
    <title>Channel Penjualan - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body>
    <?= $this->include('components/top_navbar') ?>

    <div class="container-fluid container-max-wide py-3 py-md-4">
        <!-- Page Header Banner -->
        <div class="card-custom border-0 p-4 mb-4 shadow-sm bg-gradient-header">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-purple-light text-purple border border-purple-subtle rounded-pill px-3 py-1 font-weight-semibold" style="color: #9333ea;">
                            <i class="bi bi-diagram-3 me-1"></i> Saluran Penjualan
                        </span>
                        <?php if (!empty($channels)) : ?>
                            <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1">
                                <?= count($channels) ?> Channel
                            </span>
                        <?php endif; ?>
                    </div>
                    <h1 class="h3 fw-bold text-dark tracking-tight mb-0">Channel Penjualan</h1>
                    <p class="text-muted small mb-0">Daftar saluran atau media platform usaha Anda</p>
                </div>
                <div>
                    <a href="<?= site_url('channels/create') ?>" class="btn btn-primary rounded-pill px-3.5 py-2 d-inline-flex align-items-center gap-2 shadow-sm font-weight-semibold">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Channel</span>
                    </a>
                </div>
            </div>
        </div>

        <?php if (empty($channels)) : ?>
            <div class="card-custom p-5 text-center my-4">
                <div class="bg-purple-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-diagram-3 fs-3" style="color: #9333ea;"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Channel Penjualan</h6>
                <p class="text-muted small mb-3">Tambahkan channel (seperti WhatsApp, Shopee, Toko Fisik) untuk memisahkan performa</p>
                <div>
                    <a href="<?= site_url('channels/create') ?>" class="btn btn-primary btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Channel Pertama
                    </a>
                </div>
            </div>
        <?php else : ?>
            <!-- Desktop / Laptop View (Table Layout) -->
            <div class="card-custom d-none d-md-block overflow-hidden mb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr class="text-muted small fw-semibold">
                                <th class="ps-4 py-3" style="width: 100px;">ID</th>
                                <th class="py-3">Nama Channel</th>
                                <th class="py-3 text-center" style="width: 120px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($channels as $channel) : ?>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <span class="badge bg-light text-secondary border fw-normal">
                                            #<?= esc($channel['id']) ?>
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-purple-light rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;">
                                                <i class="bi bi-diagram-3-fill" style="color: #9333ea;"></i>
                                            </div>
                                            <span class="fw-bold text-dark fs-6">
                                                <?= esc($channel['name']) ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 small">
                                            Aktif
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View (Card List) -->
            <div class="d-md-none d-flex flex-column gap-3 mb-4">
                <?php foreach ($channels as $channel) : ?>
                    <div class="card-custom p-3 hover-lift">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-purple-light rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                <i class="bi bi-diagram-3-fill fs-5" style="color: #9333ea;"></i>
                            </div>
                            <div class="min-w-0 flex-grow-1">
                                <h6 class="fw-bold text-dark text-truncate mb-0">
                                    <?= esc($channel['name']) ?>
                                </h6>
                                <span class="badge bg-light text-muted border font-weight-normal small">
                                    ID: #<?= esc($channel['id']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?= $this->include('components/bottom_nav') ?>
</body>
</html>