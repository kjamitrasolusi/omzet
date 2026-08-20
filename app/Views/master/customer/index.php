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

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 24px;
        }

        .subtitle {
            margin: 0 0 20px;
            color: #6b7280;
            font-size: 14px;
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

            <!-- <a href="<?= site_url('home') ?>" class="back">
        ← Kembali
    </a> -->

            <h1>Pelanggan</h1>

            <p class="subtitle">
                Daftar pelanggan usaha
            </p>

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