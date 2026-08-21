<!DOCTYPE html>
<html lang="id">
<head>
    <title>Profil Usaha - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body>
    <?= $this->include('components/top_navbar') ?>

    <div class="container-fluid container-max-wide py-4">
        <div class="form-card-container">
            <div class="card-custom p-4 p-md-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <div class="bg-blue-light rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                        <i class="bi bi-building-gear fs-5"></i>
                    </div>
                    <div>
                        <h1 class="h5 fw-bold text-dark mb-0">Profil Usaha</h1>
                        <p class="text-muted small mb-0">Kelola identitas dan nama unit bisnis Anda</p>
                    </div>
                </div>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success rounded-3 d-flex align-items-center gap-2 mb-4 py-2 px-3 small">
                        <i class="bi bi-check-circle-fill fs-6"></i>
                        <div><?= esc(session()->getFlashdata('success')) ?></div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 mb-4 py-2 px-3 small">
                        <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                        <div><?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('business/profile/update') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-dark small">Nama Usaha <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                <i class="bi bi-building"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control border-start-0 rounded-end-3"
                                id="name"
                                name="name"
                                value="<?= esc(old('name', $business['name'])) ?>"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="business_id" class="form-label fw-semibold text-dark small">ID Sistem Usaha</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                <i class="bi bi-key"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control border-start-0 rounded-end-3 bg-light text-muted"
                                id="business_id"
                                value="<?= esc($business['id']) ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 shadow-sm fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->include('components/bottom_nav') ?>
</body>
</html>