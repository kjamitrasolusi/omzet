<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Penjualan - UMKM Sales Insight</title>
    <?= $this->include('components/app_head') ?>
</head>
<body>
    <?= $this->include('components/top_navbar') ?>

    <div class="container-fluid container-max-wide py-4">
        <div class="form-card-container">
            <div class="card-custom p-4 p-md-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <div class="bg-blue-light rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    <div>
                        <h1 class="h5 fw-bold text-dark mb-0">Edit Transaksi Penjualan</h1>
                        <p class="text-muted small mb-0">Perbarui data transaksi (ID: #<?= esc($sale['id']) ?>)</p>
                    </div>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 mb-4 py-2 px-3 small">
                        <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                        <div><?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('sales/edit/update/' . $sale['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label for="transaction_date" class="form-label fw-semibold text-dark small">Tanggal Transaksi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                                <input
                                    type="date"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="transaction_date"
                                    name="transaction_date"
                                    value="<?= esc(old('transaction_date', $sale['transaction_date'])) ?>"
                                    required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="product_id" class="form-label fw-semibold text-dark small">Produk <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-box-seam"></i>
                                </span>
                                <select class="form-select border-start-0 rounded-end-3" id="product_id" name="product_id" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php foreach ($products as $product) : ?>
                                        <option
                                            value="<?= esc($product['id']) ?>"
                                            <?= old('product_id', $sale['product_id']) == $product['id'] ? 'selected' : '' ?>>
                                            <?= esc($product['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label fw-semibold text-dark small">Jumlah Qty <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input
                                    type="number"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="quantity"
                                    name="quantity"
                                    min="0.01"
                                    step="0.01"
                                    value="<?= esc(old('quantity', $sale['quantity'])) ?>"
                                    required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="amount" class="form-label fw-semibold text-dark small">Total Penjualan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3 fw-bold">
                                    Rp
                                </span>
                                <input
                                    type="number"
                                    class="form-control border-start-0 rounded-end-3"
                                    id="amount"
                                    name="amount"
                                    min="0"
                                    step="1"
                                    value="<?= esc(old('amount', $sale['amount'])) ?>"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label for="customer_id" class="form-label fw-semibold text-dark small">Pelanggan <span class="text-muted font-weight-normal font-size-12">(opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-person"></i>
                                </span>
                                <select class="form-select border-start-0 rounded-end-3" id="customer_id" name="customer_id">
                                    <option value="">Tanpa Pelanggan</option>
                                    <?php foreach ($customers as $customer) : ?>
                                        <option
                                            value="<?= esc($customer['id']) ?>"
                                            <?= old('customer_id', $sale['customer_id']) == $customer['id'] ? 'selected' : '' ?>>
                                            <?= esc($customer['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="channel_id" class="form-label fw-semibold text-dark small">Channel Penjualan <span class="text-muted font-weight-normal font-size-12">(opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                                <select class="form-select border-start-0 rounded-end-3" id="channel_id" name="channel_id">
                                    <option value="">Pilih Channel</option>
                                    <?php foreach ($channels as $channel) : ?>
                                        <option
                                            value="<?= esc($channel['id']) ?>"
                                            <?= old('channel_id', $sale['channel_id']) == $channel['id'] ? 'selected' : '' ?>>
                                            <?= esc($channel['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 shadow-sm fw-semibold w-100 w-sm-auto">
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