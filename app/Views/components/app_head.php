<!-- Lokasi: app/Views/components/app_head.php -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- PWA Meta Tags -->
<meta name="theme-color" content="#2563eb">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="OmzetInsight">
<link rel="manifest" href="<?= base_url('manifest.json') ?>">
<link rel="apple-touch-icon" href="<?= base_url('icons/icon.svg') ?>">

<!-- Bootstrap 5.3 CSS & Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Custom Design System Stylesheet -->
<link rel="stylesheet" href="<?= base_url('css/app.css') ?>">

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

<!-- PWA Service Worker Registration -->
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('<?= base_url('sw.js') ?>')
            .then(reg => console.log('[PWA] Service Worker registered:', reg.scope))
            .catch(err => console.warn('[PWA] Service Worker failed:', err));
    });
}
</script>
