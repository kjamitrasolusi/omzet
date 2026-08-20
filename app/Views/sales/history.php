<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Riwayat Penjualan - UMKM Sales Insight</title>

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
            max-width: 700px;
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

        /* SALES LIST */

        .sales-list {
            width: 100%;
        }

        /* SALE CARD */

        .sale-card {
            width: 100%;
            margin-bottom: 12px;
            padding: 16px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
        }

        .sale-date {
            margin-bottom: 8px;
            color: #6b7280;
            font-size: 13px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.45;
        }

        .sale-detail {
            margin-top: 8px;
            color: #4b5563;
            font-size: 14px;
        }

        /* META */

        .sale-meta {
            display: block;
            margin-top: 12px;
        }

        .badge {
            display: inline-block;
            margin-right: 8px;
            margin-bottom: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f3f4f6;
            color: #4b5563;
            font-size: 12px;
            line-height: 1;
        }

        /* AMOUNT */

        .sale-amount {
            margin-top: 10px;
            color: #111827;
            font-size: 18px;
            font-weight: 700;
        }

        /* EMPTY */

        .empty {
            padding: 30px 20px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            text-align: center;
            color: #6b7280;
        }

        /* DESKTOP */

        @media (min-width: 768px) {

            .page {
                padding: 40px 20px;
            }

            .container {
                max-width: 700px;
            }

            .sale-card {
                padding: 20px;
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
                href="<?= site_url('home') ?>"
                class="back"
            >
                ← Kembali
            </a>

            <h1>
                Riwayat Penjualan
            </h1>

            <p class="subtitle">
                Daftar transaksi penjualan usaha
            </p>

        </div>


        <!-- DATA -->

        <?php if (empty($sales)) : ?>

            <div class="empty">

                Belum ada transaksi penjualan.

            </div>

        <?php else : ?>

            <div class="sales-list">


                <?php foreach ($sales as $sale) : ?>


                    <div class="sale-card">


                        <!-- TANGGAL -->

                        <div class="sale-date">

                            <?php

                            $bulan = [
                                1  => 'Januari',
                                2  => 'Februari',
                                3  => 'Maret',
                                4  => 'April',
                                5  => 'Mei',
                                6  => 'Juni',
                                7  => 'Juli',
                                8  => 'Agustus',
                                9  => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember'
                            ];

                            $timestamp = strtotime(
                                $sale['transaction_date']
                            );

                            echo date('d', $timestamp)
                                . ' '
                                . $bulan[
                                    (int) date('n', $timestamp)
                                ]
                                . ' '
                                . date('Y', $timestamp);

                            ?>

                        </div>


                        <!-- PRODUK -->

                        <div class="product-name">

                            <?= esc(
                                $sale['product_name']
                            ) ?>

                        </div>


                        <!-- JUMLAH -->

                        <div class="sale-detail">

                            <?= number_format(
                                (float) $sale['quantity'],
                                0,
                                ',',
                                '.'
                            ) ?>

                            unit

                        </div>


                        <!-- CUSTOMER + CHANNEL -->

                        <div class="sale-meta">


                            <?php if (
                                !empty(
                                    $sale['customer_name']
                                )
                            ) : ?>

                                <span class="badge">

                                    <?= esc(
                                        $sale['customer_name']
                                    ) ?>

                                </span>

                            <?php endif; ?>


                            <?php if (
                                !empty(
                                    $sale['channel_name']
                                )
                            ) : ?>

                                <span class="badge">

                                    <?= esc(
                                        $sale['channel_name']
                                    ) ?>

                                </span>

                            <?php endif; ?>


                        </div>


                        <!-- NILAI -->

                        <div class="sale-amount">

                            Rp <?= number_format(
                                (float) $sale['amount'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </div>


                    </div>


                <?php endforeach; ?>


            </div>

        <?php endif; ?>


    </div>

</div>


</body>

</html>