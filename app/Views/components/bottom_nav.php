<!-- Lokasi: app/Views/components/bottom_nav.php -->
<?php
$currentPath = trim(uri_string(), '/');
if ($currentPath === '') {
    $currentPath = 'home';
}
?>
<style>
    /* ==========================================
       DRY UNIVERSAL NAVIGATION COMPONENT WITH BOOTSTRAP ICONS
    ========================================== */
    body {
        padding-bottom: 76px !important;
    }

    .bottom-nav {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1050;
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 8px 4px;
        background: rgba(255, 255, 255, 0.98);
        border-top: 1px solid var(--border-color, #e2e8f0);
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
        scrollbar-width: none;
    }

    .bottom-nav::-webkit-scrollbar {
        display: none;
    }

    .nav-item-custom {
        flex: 1 1 0%;
        min-width: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 6px 2px;
        color: #64748b;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
        line-height: 1.2;
        border-radius: 10px;
        transition: all 0.15s ease;
    }

    .nav-item-custom i {
        font-size: 18px;
        line-height: 1;
    }

    .nav-item-custom span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }

    .nav-item-custom.active {
        color: #2563eb;
        font-weight: 700;
    }

    .nav-item-custom:active {
        transform: scale(0.95);
    }

    /* DESKTOP / LAPTOP RESPONSIVE (>= 768px) */
    @media (min-width: 768px) {
        body {
            padding-bottom: 90px !important;
        }

        .bottom-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 32px);
            max-width: 720px;
            margin: 0 auto;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color, #e2e8f0);
            border-radius: 18px;
            box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
            justify-content: space-evenly;
        }

        .nav-item-custom {
            max-width: 95px;
            padding: 8px 10px;
            font-size: 12px;
        }

        .nav-item-custom:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .nav-item-custom.active {
            background: #eff6ff;
            color: #2563eb;
        }
    }
</style>

<nav class="bottom-nav" aria-label="Navigasi Utama">
    <a href="<?= site_url('home') ?>" class="nav-item-custom <?= ($currentPath === 'home' || url_is('home*')) ? 'active' : '' ?>">
        <i class="bi bi-grid-1x2<?= ($currentPath === 'home' || url_is('home*')) ? '-fill' : '' ?>"></i>
        <span>Dashboard</span>
    </a>

    <a href="<?= site_url('sales/history') ?>" class="nav-item-custom <?= (strpos($currentPath, 'sales') === 0 || url_is('sales*')) ? 'active' : '' ?>">
        <i class="bi bi-receipt<?= (strpos($currentPath, 'sales') === 0 || url_is('sales*')) ? '-cutoff' : '' ?>"></i>
        <span>Penjualan</span>
    </a>

    <a href="<?= site_url('products') ?>" class="nav-item-custom <?= (strpos($currentPath, 'products') === 0 || url_is('products*')) ? 'active' : '' ?>">
        <i class="bi bi-box-seam<?= (strpos($currentPath, 'products') === 0 || url_is('products*')) ? '-fill' : '' ?>"></i>
        <span>Produk</span>
    </a>

    <a href="<?= site_url('customers') ?>" class="nav-item-custom <?= (strpos($currentPath, 'customers') === 0 || url_is('customers*')) ? 'active' : '' ?>">
        <i class="bi bi-people<?= (strpos($currentPath, 'customers') === 0 || url_is('customers*')) ? '-fill' : '' ?>"></i>
        <span>Pelanggan</span>
    </a>

    <a href="<?= site_url('channels') ?>" class="nav-item-custom <?= (strpos($currentPath, 'channels') === 0 || url_is('channels*')) ? 'active' : '' ?>">
        <i class="bi bi-diagram-3<?= (strpos($currentPath, 'channels') === 0 || url_is('channels*')) ? '-fill' : '' ?>"></i>
        <span>Channel</span>
    </a>

    <a href="<?= site_url('business/profile') ?>" class="nav-item-custom <?= (strpos($currentPath, 'business') === 0 || url_is('business*')) ? 'active' : '' ?>">
        <i class="bi bi-gear<?= (strpos($currentPath, 'business') === 0 || url_is('business*')) ? '-fill' : '' ?>"></i>
        <span>Usaha</span>
    </a>
</nav>