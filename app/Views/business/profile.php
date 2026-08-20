<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Profil Usaha - Omzet Insight
    </title>


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
            min-height: 100vh;
            padding: 16px;
            padding-bottom: 90px;
        }


        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }


        .header {
            margin-bottom: 20px;
        }


        .header h1 {
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
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
        }


        .alert.success {
            background: #ecfdf5;
            color: #065f46;
        }


        .alert.error {
            background: #fef2f2;
            color: #991b1b;
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


        input {
            width: 100%;
            min-height: 48px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            color: #111827;
            font-size: 16px;
        }


        input:focus {
            outline: none;
            border-color: #2563eb;
        }


        .readonly {
            background: #f9fafb;
            color: #6b7280;
        }


        .button {
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


            <div class="header">

                <h1>
                    Profil Usaha
                </h1>

                <p class="subtitle">
                    Kelola informasi dasar usaha Anda
                </p>

            </div>


            <?php if (
                session()->getFlashdata('success')
            ) : ?>

                <div class="alert success">

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                </div>

            <?php endif; ?>


            <?php if (
                session()->getFlashdata('error')
            ) : ?>

                <div class="alert error">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <div class="card">


                <form
                    method="post"
                    action="<?= site_url(
                                'business/profile/update'
                            ) ?>">

                    <?= csrf_field() ?>


                    <div class="form-group">

                        <label for="name">
                            Nama Usaha
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= esc(
                                        old(
                                            'name',
                                            $business['name']
                                        )
                                    ) ?>"
                            required>

                    </div>


                    <div class="form-group">

                        <label>
                            Business ID
                        </label>

                        <input
                            type="text"
                            value="<?= esc(
                                        $business['id']
                                    ) ?>"
                            class="readonly"
                            readonly>

                    </div>


                    <button
                        type="submit"
                        class="button">
                        Simpan Perubahan
                    </button>


                </form>


            </div>


        </div>


    </div>
    <?= $this->include('components/bottom_nav') ?>

    <!-- BOTTOM NAVIGATION -->

    <!-- <nav class="bottom-nav">


        <a
            href="<?= site_url('home') ?>"
            class="nav-item">

            <span>⌂</span>
            <span>Dashboard</span>

        </a>


        <a
            href="<?= site_url('sales') ?>"
            class="nav-item">

            <span>▣</span>
            <span>Penjualan</span>

        </a>


        <a
            href="<?= site_url('products') ?>"
            class="nav-item">

            <span>◫</span>
            <span>Produk</span>

        </a>


        <a
            href="<?= site_url('customers') ?>"
            class="nav-item">

            <span>♙</span>
            <span>Pelanggan</span>

        </a>


        <a
            href="<?= site_url('business/profile') ?>"
            class="nav-item active">

            <span>⚙</span>
            <span>Usaha</span>

        </a>


    </nav> -->


</body>

</html>