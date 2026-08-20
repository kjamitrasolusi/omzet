<?php

$currentPath = trim(
    uri_string(),
    '/'
);

if ($currentPath === '') {
    $currentPath = 'home';
}
?>

<nav class="bottom-nav">

    <a
        href="<?= site_url('home') ?>"
        class="nav-item <?= $currentPath === 'home' ? 'active' : '' ?>"
    >
        <span class="nav-icon">⌂</span>
        <span>Dashboard</span>
    </a>


    <a
        href="<?= site_url('sales') ?>"
        class="nav-item <?= strpos($currentPath, 'sales') === 0 ? 'active' : '' ?>"
    >
        <span class="nav-icon">▣</span>
        <span>Penjualan</span>
    </a>


    <a
        href="<?= site_url('products') ?>"
        class="nav-item <?= strpos($currentPath, 'products') === 0 ? 'active' : '' ?>"
    >
        <span class="nav-icon">◫</span>
        <span>Produk</span>
    </a>


    <a
        href="<?= site_url('customers') ?>"
        class="nav-item <?= strpos($currentPath, 'customers') === 0 ? 'active' : '' ?>"
    >
        <span class="nav-icon">♙</span>
        <span>Pelanggan</span>
    </a>


    <a
        href="<?= site_url('channels') ?>"
        class="nav-item <?= strpos($currentPath, 'channels') === 0 ? 'active' : '' ?>"
    >
        <span class="nav-icon">⌁</span>
        <span>Channel</span>
    </a>


    <a
        href="<?= site_url('business/profile') ?>"
        class="nav-item <?= strpos($currentPath, 'business') === 0 ? 'active' : '' ?>"
    >
        <span class="nav-icon">⚙</span>
        <span>Usaha</span>
    </a>


    <a
        href="<?= site_url('logout') ?>"
        class="nav-item logout"
    >
        <span class="nav-icon">↪</span>
        <span>Keluar</span>
    </a>

</nav>