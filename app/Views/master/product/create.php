<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk - UMKM Sales Insight</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        .card {
            background: #ffffff;
            padding: 22px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 22px;
        }

        .subtitle {
            margin: 0 0 22px;
            color: #6b7280;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .btn {
            width: 100%;
            height: 48px;
            border: 0;
            border-radius: 10px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 14px;
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

            <!-- <a href="<?= site_url('products') ?>" class="back">
                ← Kembali ke Produk
            </a> -->

            <div class="card">

                <h1>Tambah Produk</h1>

                <p class="subtitle">
                    Tambahkan produk yang dijual usaha.
                </p>

                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>

                <?php endif; ?>

                <form action="<?= site_url('products/store') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="form-group">

                        <label for="name">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= old('name') ?>"
                            placeholder="Contoh: Kopi Aren"
                            autocomplete="off"
                            required>

                    </div>

                    <button type="submit" class="btn">
                        Simpan Produk
                    </button>

                </form>

            </div>

        </div>
    </div>
    <?= $this->include('components/bottom_nav') ?>

</body>

</html>