<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Penjualan Baru - UMKM Sales Insight</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fa;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }

        .page {
            width: 100%;
            min-height: 100vh;
            padding: 16px;
        }

        .container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 14px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        .back:hover {
            text-decoration: underline;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .subtitle {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            min-height: 48px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            font-size: 16px;
            color: #111827;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .optional {
            font-size: 12px;
            color: #9ca3af;
            font-weight: normal;
        }

        .submit-button {
            width: 100%;
            min-height: 50px;
            margin-top: 6px;
            border: 0;
            border-radius: 11px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #1d4ed8;
        }

        .submit-button:active {
            transform: scale(0.99);
        }

        /*
         * ==============================
         * NAVIGATION
         * ==============================
         */

        .bottom-nav {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;

            display: flex;
            justify-content: space-around;

            padding: 8px 6px;

            background: #ffffff;
            border-top: 1px solid #e5e7eb;

            z-index: 1000;
        }


        .nav-item {
            flex: 1;

            display: flex;
            flex-direction: column;
            align-items: center;

            gap: 3px;

            padding: 6px 2px;

            color: #6b7280;

            text-decoration: none;

            font-size: 11px;
        }


        .nav-item span:first-child {
            font-size: 19px;
        }


        .nav-item.active {
            color: #2563eb;
            font-weight: 700;
        }

        @media (min-width: 768px) {

            .page {
                padding: 40px 20px;
            }

            .container {
                max-width: 600px;
            }

            .card {
                padding: 28px;
            }

        }
    </style>

</head>

<body>

    <div class="page">

        <div class="container">

            <!-- HEADER -->

            <div class="header">

                <!-- <a
                    href="<?= site_url('home') ?>"
                    class="back">
                    ← Kembali
                </a> -->

                <h1>Penjualan Baru</h1>

                <p class="subtitle">
                    Catat transaksi penjualan
                </p>

            </div>


            <!-- CARD -->

            <div class="card">


                <!-- ERROR MESSAGE -->

                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert alert-error">

                        <?= esc(session()->getFlashdata('error')) ?>

                    </div>

                <?php endif; ?>


                <!-- SUCCESS MESSAGE -->

                <?php if (session()->getFlashdata('success')) : ?>

                    <div class="alert alert-success">

                        <?= esc(session()->getFlashdata('success')) ?>

                    </div>

                <?php endif; ?>


                <!-- FORM -->

                <form
                    action="<?= site_url('sales/store') ?>"
                    method="post">

                    <?= csrf_field() ?>


                    <!-- TANGGAL -->

                    <div class="form-group">

                        <label for="transaction_date">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            id="transaction_date"
                            name="transaction_date"
                            value="<?= old('transaction_date', date('Y-m-d')) ?>"
                            required>

                    </div>


                    <!-- PRODUCT -->

                    <div class="form-group">

                        <label for="product_id">
                            Produk
                        </label>

                        <select
                            id="product_id"
                            name="product_id"
                            required>

                            <option value="">
                                Pilih produk
                            </option>

                            <?php foreach ($products as $product) : ?>

                                <option
                                    value="<?= esc($product['id']) ?>"
                                    <?= old('product_id') == $product['id'] ? 'selected' : '' ?>>
                                    <?= esc($product['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- QUANTITY -->

                    <div class="form-group">

                        <label for="quantity">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            min="1"
                            step="1"
                            value="<?= old('quantity') ?>"
                            placeholder="Contoh: 2"
                            required>

                    </div>


                    <!-- AMOUNT -->

                    <div class="form-group">

                        <label for="amount">
                            Nilai Penjualan
                        </label>

                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            min="0"
                            step="1"
                            value="<?= old('amount') ?>"
                            placeholder="Contoh: 50000"
                            required>

                    </div>


                    <!-- CUSTOMER -->

                    <div class="form-group">

                        <label for="customer_id">

                            Pelanggan

                            <span class="optional">
                                (opsional)
                            </span>

                        </label>

                        <select
                            id="customer_id"
                            name="customer_id">

                            <option value="">
                                Tanpa pelanggan
                            </option>

                            <?php foreach ($customers as $customer) : ?>

                                <option
                                    value="<?= esc($customer['id']) ?>"
                                    <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>>
                                    <?= esc($customer['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- CHANNEL -->

                    <div class="form-group">

                        <label for="channel_id">

                            Channel

                            <span class="optional">
                                (opsional)
                            </span>

                        </label>

                        <select
                            id="channel_id"
                            name="channel_id">

                            <option value="">
                                Pilih channel
                            </option>

                            <?php foreach ($channels as $channel) : ?>

                                <option
                                    value="<?= esc($channel['id']) ?>"
                                    <?= old('channel_id') == $channel['id'] ? 'selected' : '' ?>>
                                    <?= esc($channel['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- SUBMIT -->

                    <button
                        type="submit"
                        class="submit-button">
                        Simpan Penjualan
                    </button>

                </form>

            </div>

        </div>

    </div>
    <?= $this->include('components/bottom_nav') ?>
</body>

</html>