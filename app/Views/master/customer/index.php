<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pelanggan - UMKM Sales Insight</title>

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
            max-width: 900px;
            margin: auto;
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


        .customer-list {
            display: grid;
            gap: 10px;
        }

        .customer-item {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
        }

        .customer-name {
            font-weight: 600;
            font-size: 16px;
        }

        .customer-phone {
            margin-top: 5px;
            color: #6b7280;
            font-size: 13px;
        }

        .customer-id {
            margin-top: 5px;
            color: #9ca3af;
            font-size: 12px;
        }

        .empty {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            color: #6b7280;
        }

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


                <div class="header-row">


                    <div class="header-title">

                        <h1>
                            Pelanggan
                        </h1>

                        <p class="subtitle">
                            Daftar pelanggan usaha
                        </p>

                    </div>


                    <a
                        href="<?= site_url('customers/create') ?>"
                        class="add-button">
                        + Tambah pelanggan
                    </a>


                </div>


            </div>



            <?php if (empty($customers)) : ?>

                <div class="empty">
                    Belum ada pelanggan.
                </div>

            <?php else : ?>

                <div class="customer-list">

                    <?php foreach ($customers as $customer) : ?>

                        <div class="customer-item">

                            <div class="customer-name">
                                <?= esc($customer['name']) ?>
                            </div>

                            <?php if (!empty($customer['phone'])) : ?>
                                <div class="customer-phone">
                                    <?= esc($customer['phone']) ?>
                                </div>
                            <?php endif; ?>

                            <div class="customer-id">
                                ID: <?= esc($customer['id']) ?>
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