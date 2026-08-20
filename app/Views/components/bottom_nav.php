<!-- Lokasi: app/Views/components/bottom_nav.php -->
<nav class="bottom-nav">
    <a href="<?= site_url('home') ?>" class="nav-item <?= url_is('home*') ? 'active' : '' ?>">
        <span>⌂</span>
        <span>Dashboard</span>
    </a>

    <a href="<?= site_url('sales/input') ?>" class="nav-item <?= url_is('sales*') ? 'active' : '' ?>">
        <span>▣</span>
        <span>Penjualan</span>
    </a>

    <a href="<?= site_url('products') ?>" class="nav-item <?= url_is('products*') ? 'active' : '' ?>">
        <span>◫</span>
        <span>Produk</span>
    </a>

    <a href="<?= site_url('customers') ?>" class="nav-item <?= url_is('customers*') ? 'active' : '' ?>">
        <span>♙</span>
        <span>Pelanggan</span>
    </a>
    <a href="<?= site_url('channels') ?>" class="nav-item <?= url_is('channels*') ? 'active' : '' ?>">
        <span>⌁</span>
        <span>Channel</span>
    </a>

    <a href="<?= site_url('business/profile') ?>" class="nav-item <?= url_is('business/profile*') ? 'active' : '' ?>">
        <span>⚙</span>
        <span>Usaha</span>
    </a>
</nav>