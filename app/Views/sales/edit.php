<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Penjualan - UMKM Sales Insight</title>


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
            max-width: 600px;
            margin: 0 auto;
        }


        /* HEADER */

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
            line-height: 1.3;
        }


        .subtitle {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 14px;
        }


        /* CARD */

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
        }


        /* ALERT */

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 14px;
        }


        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }


        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }


        .optional {
            font-size: 12px;
            color: #9ca3af;
            font-weight: normal;
        }


        input,
        select {
            width: 100%;
            min-height: 48px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            color: #111827;
            font-size: 16px;
        }


        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }


        /* BUTTONS */

        .actions {
            margin-top: 8px;
        }


        .submit-button {
            width: 100%;
            min-height: 50px;
            border: 0;
            border-radius: 11px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }


        .submit-button:active {
            transform: scale(0.99);
        }


        .cancel-button {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 11px;
            background: #ffffff;
            color: #374151;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
        }


        /* DESKTOP */

        @media (min-width: 768px) {

            .page {
                padding: 40px 20px;
            }


            .card {
                padding: 28px;
            }


            h1 {
                font-size: 26px;
            }

        }

    </style>

</head>


<body>


<div class="page">


    <div class="container">


        <!-- HEADER -->

        <div class="header">


            <a
                href="<?= site_url('sales/history') ?>"
                class="back"
            >
                ← Kembali
            </a>


            <h1>
                Edit Penjualan
            </h1>


            <p class="subtitle">
                Perbarui data transaksi penjualan
            </p>


        </div>


        <!-- CARD -->

        <div class="card">


            <!-- ERROR -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- FORM -->

            <form
                method="post"
                action="<?= site_url(
                    'sales/edit/update/' . $sale['id']
                ) ?>"
            >


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
                        value="<?= esc(
                            old(
                                'transaction_date',
                                $sale['transaction_date']
                            )
                        ) ?>"
                        required
                    >


                </div>


                <!-- PRODUK -->

                <div class="form-group">


                    <label for="product_id">

                        Produk

                    </label>


                    <select
                        id="product_id"
                        name="product_id"
                        required
                    >


                        <option value="">
                            Pilih produk
                        </option>


                        <?php foreach (
                            $products as $product
                        ) : ?>


                            <option
                                value="<?= esc(
                                    $product['id']
                                ) ?>"
                                <?= old(
                                    'product_id',
                                    $sale['product_id']
                                ) == $product['id']
                                    ? 'selected'
                                    : '' ?>
                            >

                                <?= esc(
                                    $product['name']
                                ) ?>

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
                        min="0.01"
                        step="0.01"
                        value="<?= esc(
                            old(
                                'quantity',
                                $sale['quantity']
                            )
                        ) ?>"
                        required
                    >


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
                        value="<?= esc(
                            old(
                                'amount',
                                $sale['amount']
                            )
                        ) ?>"
                        required
                    >


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
                        name="customer_id"
                    >


                        <option value="">
                            Tanpa pelanggan
                        </option>


                        <?php foreach (
                            $customers as $customer
                        ) : ?>


                            <option
                                value="<?= esc(
                                    $customer['id']
                                ) ?>"
                                <?= old(
                                    'customer_id',
                                    $sale['customer_id']
                                ) == $customer['id']
                                    ? 'selected'
                                    : '' ?>
                            >

                                <?= esc(
                                    $customer['name']
                                ) ?>

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
                        name="channel_id"
                    >


                        <option value="">
                            Pilih channel
                        </option>


                        <?php foreach (
                            $channels as $channel
                        ) : ?>


                            <option
                                value="<?= esc(
                                    $channel['id']
                                ) ?>"
                                <?= old(
                                    'channel_id',
                                    $sale['channel_id']
                                ) == $channel['id']
                                    ? 'selected'
                                    : '' ?>
                            >

                                <?= esc(
                                    $channel['name']
                                ) ?>

                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>


                <!-- ACTION -->

                <div class="actions">


                    <button
                        type="submit"
                        class="submit-button"
                    >
                        Simpan Perubahan
                    </button>


                    <a
                        href="<?= site_url(
                            'sales/history'
                        ) ?>"
                        class="cancel-button"
                    >
                        Batal
                    </a>


                </div>


            </form>


        </div>


    </div>


</div>


</body>

</html>