<!DOCTYPE html>
<html lang="id">
<head>
    <title>Buat Usaha - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body class="bg-light">
    <div class="container py-5 min-vh-100 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow mb-2" style="width: 48px; height: 48px;">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                    <h2 class="h4 fw-bold text-dark mb-1">Buat Usaha Anda</h2>
                    <p class="text-muted small">Satu langkah lagi untuk mulai mengelola penjualan</p>
                </div>

                <div class="card-custom p-4 p-md-5">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            <div><?= esc(session()->getFlashdata('error')) ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('business/store') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Nama Usaha / Toko <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-shop"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="name"
                                    name="name"
                                    value="<?= esc(old('name')) ?>"
                                    placeholder="Contoh: Toko Berkah, Khassava"
                                    autocomplete="organization"
                                    required
                                    autofocus>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-3 py-2-5 shadow-sm fw-bold">
                                Mulai Menggunakan Aplikasi <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>