<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Channel - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body>
    <?= $this->include('components/top_navbar') ?>

    <div class="container-fluid container-max-wide py-4">
        <div class="form-card-container">
            <div class="card-custom p-4 p-md-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <div class="bg-purple-light rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                        <i class="bi bi-diagram-3-fill fs-5"></i>
                    </div>
                    <div>
                        <h1 class="h5 fw-bold text-dark mb-0">Tambah Channel</h1>
                        <p class="text-muted small mb-0">Tambahkan saluran atau platform tempat Anda berjualan</p>
                    </div>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 mb-4 py-2 px-3 small">
                        <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                        <div><?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('channels/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-dark small">Nama Channel <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                <i class="bi bi-diagram-3"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control border-start-0 rounded-end-3"
                                id="name"
                                name="name"
                                value="<?= old('name') ?>"
                                placeholder="Contoh: WhatsApp, Shopee, Toko Fisik"
                                required
                                autofocus>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 shadow-sm fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Simpan Channel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->include('components/bottom_nav') ?>
</body>
</html>