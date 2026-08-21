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

            <!-- Tombol Install PWA: hanya muncul di HP jika belum install, disembunyikan secara default -->
            <button
                id="pwa-install-btn"
                class="btn btn-sm rounded-pill px-2-5 py-1-5 d-none d-md-none align-items-center gap-1-5 shadow-sm fw-semibold"
                style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; font-size: 12px;"
                title="Pasang aplikasi ke layar utama">
                <i class="bi bi-download"></i>
                <span class="d-none d-sm-inline">Pasang App</span>
            </button>

            <!-- Logout button: tampil di semua layar -->
            <a href="<?= site_url('logout') ?>" class="btn btn-light text-danger border btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center shadow-xs hover-danger" style="width: 34px; height: 34px;" title="Keluar dari akun">
                <i class="bi bi-box-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</nav>

<!-- PWA Banner untuk HP (muncul di bagian atas saat bisa di-install) -->
<div id="pwa-banner" class="d-none" style="
    background: linear-gradient(135deg, #1e40af, #2563eb);
    color: white;
    padding: 10px 16px;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    position: sticky;
    top: 64px;
    z-index: 1010;
    box-shadow: 0 2px 8px rgba(37,99,235,0.25);
">
    <div class="d-flex align-items-center gap-2">
        <div style="width:32px;height:32px;background:rgba(255,255,255,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <div>
            <div style="font-weight:700;font-size:13px;line-height:1.2;">Pasang OmzetInsight</div>
            <div style="font-size:11px;opacity:0.85;">Akses lebih cepat dari layar utama HP</div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-1-5 flex-shrink-0">
        <button id="pwa-banner-install" style="background:white;color:#2563eb;border:none;border-radius:20px;padding:5px 14px;font-size:12px;font-weight:700;cursor:pointer;">
            Pasang
        </button>
        <button id="pwa-banner-dismiss" style="background:transparent;color:rgba(255,255,255,0.7);border:1px solid rgba(255,255,255,0.3);border-radius:20px;padding:5px 10px;font-size:12px;cursor:pointer;">
            Nanti
        </button>
    </div>
</div>

<script>
(function() {
    let deferredPrompt = null;
    const banner = document.getElementById('pwa-banner');
    const installBtn = document.getElementById('pwa-install-btn');
    const bannerInstall = document.getElementById('pwa-banner-install');
    const bannerDismiss = document.getElementById('pwa-banner-dismiss');

    // Jangan tampilkan jika sudah pernah dismiss
    const dismissed = sessionStorage.getItem('pwa-banner-dismissed');

    // Tangkap event beforeinstallprompt dari browser
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Tampilkan banner di HP jika belum dismiss
        if (!dismissed && window.innerWidth < 768) {
            banner.classList.remove('d-none');
            banner.style.display = 'flex';
        }

        // Tampilkan tombol install di navbar HP
        if (installBtn) {
            installBtn.classList.remove('d-none');
            installBtn.style.display = 'inline-flex';
        }
    });

    // Fungsi trigger install prompt
    function triggerInstall() {
        if (!deferredPrompt) return;
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choice) => {
            if (choice.outcome === 'accepted') {
                hideBanner();
                // Tampilkan notifikasi singkat
                showToast('✅ OmzetInsight berhasil dipasang!');
            }
            deferredPrompt = null;
        });
    }

    function hideBanner() {
        if (banner) {
            banner.style.display = 'none';
            banner.classList.add('d-none');
        }
        if (installBtn) {
            installBtn.style.display = 'none';
        }
        sessionStorage.setItem('pwa-banner-dismissed', '1');
    }

    function showToast(msg) {
        const toast = document.createElement('div');
        toast.style.cssText = 'position:fixed;bottom:90px;left:50%;transform:translateX(-50%);background:#1e293b;color:white;padding:10px 20px;border-radius:100px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 4px 12px rgba(0,0,0,0.2);';
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    if (bannerInstall) bannerInstall.addEventListener('click', triggerInstall);
    if (bannerDismiss) bannerDismiss.addEventListener('click', hideBanner);
    if (installBtn) installBtn.addEventListener('click', triggerInstall);

    // Kalau sudah terinstall sebagai PWA, sembunyikan semua elemen install
    window.addEventListener('appinstalled', () => {
        hideBanner();
        deferredPrompt = null;
    });
})();
</script>
