<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Produk - UMKM Sales Insight</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
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

        /* ==============================
           HEADER
           ============================== */

        .header {
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;

            margin-bottom: 14px;

            color: #2563eb;

            text-decoration: none;

            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .header-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;
        }

        .header-title {
            min-width: 0;
        }

        .header h1 {
            margin: 0;

            font-size: 24px;

            line-height: 1.3;
        }

        .subtitle {
            margin: 6px 0 0;

            color: #6b7280;

            font-size: 14px;

            line-height: 1.5;
        }

        /* ==============================
           ADD BUTTON
           ============================== */

        .add-button {
            flex: 0 0 auto;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 42px;

            padding: 0 14px;

            background: #2563eb;

            color: #ffffff;

            border-radius: 10px;

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;

            white-space: nowrap;
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        .add-button:active {
            transform: scale(0.97);
        }

        /* ==============================
           PRODUCT LIST
           ============================== */

        .product-list {
            display: grid;

            gap: 12px;
        }

        .product-item {
            width: 100%;

            padding: 16px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 14px;
        }

        .product-name {
            font-size: 16px;

            font-weight: 700;

            line-height: 1.4;

            word-break: break-word;
        }

        .product-id {
            margin-top: 6px;

            color: #9ca3af;

            font-size: 12px;
        }

        /* ==============================
           EMPTY STATE
           ============================== */

        .empty {
            width: 100%;

            padding: 30px 20px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            color: #6b7280;

            font-size: 14px;

            text-align: center;
        }

        /* ==============================
           MOBILE
           ============================== */

        @media (max-width: 480px) {

            .page {
                padding: 16px;
            }

            .header-row {
                align-items: center;
            }

            .header h1 {
                font-size: 21px;
            }

            .subtitle {
                font-size: 13px;
            }

            .add-button {
                min-height: 40px;

                padding: 0 11px;

                font-size: 12px;
            }

            .product-item {
                padding: 14px;
            }

            .product-name {
                font-size: 15px;
            }

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
                padding-bottom: 40px;
            }


            .bottom-nav {
                position: static;

                max-width: 600px;

                margin: 24px auto 0;

                border: 1px solid #e5e7eb;
                border-radius: 14px;
            }

        }
    </style>

</head>


<body>


    <div class="page">


        <div class="container">


            <!-- ==============================
             HEADER
             ============================== -->

            <div class="header">


                <div class="header-row">


                    <div class="header-title">

                        <h1>
                            Produk
                        </h1>

                        <p class="subtitle">
                            Daftar produk usaha
                        </p>

                    </div>


                    <a
                        href="<?= site_url('products/create') ?>"
                        class="add-button">
                        + Tambah Produk
                    </a>


                </div>


            </div>


            <!-- ==============================
             PRODUCT DATA
             ============================== -->

            <?php if (empty($products)) : ?>


                <div class="empty">

                    Belum ada produk.

                </div>


            <?php else : ?>


                <div class="product-list">


                    <?php foreach ($products as $product) : ?>


                        <div class="product-item">


                            <div class="product-name">

                                <?= esc(
                                    $product['name']
                                ) ?>

                            </div>


                            <div class="product-id">

                                ID:
                                <?= esc(
                                    $product['id']
                                ) ?>

                            </div>


                        </div>


                    <?php endforeach; ?>


                </div>


            <?php endif; ?>


        </div>

    </div>
    <?= $this->include('components/bottom_nav') ?>


</body>

</html>