<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body class="bg-light">
    <div class="container py-5 min-vh-100 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow mb-2" style="width: 52px; height: 52px;">
                        <i class="bi bi-person-plus fs-3"></i>
                    </div>
                    <h1 class="h3 fw-bold text-dark mb-1">Buat Akun Baru</h1>
                    <p class="text-muted small">Mulai kelola dan pahami penjualan usaha Anda</p>
                </div>

                <div class="card-custom p-4 p-md-5">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            <div><?= esc(session()->getFlashdata('error')) ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('register/create') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="name"
                                    name="name"
                                    value="<?= esc(old('name')) ?>"
                                    placeholder="Nama Lengkap Anda"
                                    autocomplete="name"
                                    required
                                    autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input
                                    type="email"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="email"
                                    name="email"
                                    value="<?= esc(old('email')) ?>"
                                    placeholder="nama@email.com"
                                    autocomplete="email"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    autocomplete="new-password"
                                    required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label fw-semibold text-dark">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input
                                    type="password"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="password_confirm"
                                    name="password_confirm"
                                    placeholder="Ulangi password"
                                    autocomplete="new-password"
                                    required>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary rounded-3 py-2-5 shadow-sm fw-bold">
                                Daftar Sekarang <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>

                        <div class="text-center small text-muted">
                            Sudah punya akun?
                            <a href="<?= site_url('login') ?>" class="text-primary fw-bold text-decoration-none">
                                Masuk
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>