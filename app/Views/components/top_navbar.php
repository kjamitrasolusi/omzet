<!-- Lokasi: app/Views/components/top_navbar.php -->
<nav class="navbar top-header-navbar mb-3 mb-md-4 sticky-top py-2">
    <div class="container-fluid container-max-wide px-3 px-lg-4 d-flex align-items-center justify-content-between">
        <!-- Brand Logo & App Name -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary my-0" href="<?= site_url('home') ?>">
            <div class="brand-icon-box bg-primary text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px;">
                <i class="bi bi-graph-up-arrow fs-6"></i>
            </div>
            <span class="fs-5 tracking-tight text-dark fw-bold">Omzet<span class="text-primary">Insight</span></span>
        </a>

        <!-- Right Side Items -->
        <div class="d-flex align-items-center gap-2">
            <!-- "Catat Penjualan" button: hanya tampil di laptop/desktop -->
            <a href="<?= site_url('sales/input') ?>" class="btn btn-primary btn-sm rounded-pill px-3 py-1-5 d-none d-md-inline-flex align-items-center gap-1-5 shadow-sm fw-semibold">
                <i class="bi bi-plus-lg"></i>
                <span>Catat Penjualan</span>
            </a>

            <div class="vr my-1 opacity-25 d-none d-md-block"></div>

            <!-- Business Profile: hanya tampil di laptop/desktop -->
            <?php if (!empty($business['name'])) : ?>
                <a href="<?= site_url('business/profile') ?>" class="text-decoration-none d-none d-md-inline-flex align-items-center gap-1-5 text-dark bg-white border rounded-pill px-3 py-1-5 shadow-xs hover-lift small">
                    <i class="bi bi-building-gear text-primary fs-6"></i>
                    <span class="fw-semibold text-truncate" style="max-width: 160px;"><?= esc($business['name']) ?></span>
                </a>
            <?php endif; ?>

            <!-- Logout button: tampil di semua layar -->
            <a href="<?= site_url('logout') ?>" class="btn btn-light text-danger border btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center shadow-xs hover-danger" style="width: 34px; height: 34px;" title="Keluar dari akun">
                <i class="bi bi-box-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</nav>
