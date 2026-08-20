<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Channel - UMKM Sales Insight</title>

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

        .channel-list {
            display: grid;
            gap: 10px;
        }

        .channel-item {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
        }

        .channel-name {
            font-size: 16px;
            font-weight: 600;
        }

        .channel-id {
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
    </style>
</head>

<body>

<div class="container">

    <a href="<?= site_url('home') ?>" class="back">
        ← Kembali
    </a>

    <h1>Channel</h1>

    <p class="subtitle">
        Channel penjualan usaha
    </p>

    <?php if (empty($channels)) : ?>

        <div class="empty">
            Belum ada channel penjualan.
        </div>

    <?php else : ?>

        <div class="channel-list">

            <?php foreach ($channels as $channel) : ?>

                <div class="channel-item">

                    <div class="channel-name">
                        <?= esc($channel['name']) ?>
                    </div>

                    <div class="channel-id">
                        ID: <?= esc($channel['id']) ?>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>