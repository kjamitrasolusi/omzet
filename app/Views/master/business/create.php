<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Setup Usaha - UMKM Sales Insight</title>

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
            max-width: 500px;
            margin: 40px auto;
        }

        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 24px;
        }

        p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 24px;
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
            margin-bottom: 18px;
        }

        button {
            width: 100%;
            height: 48px;
            border: 0;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: 600;
        }

        .alert {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Setup Usaha</h1>

        <p>
            Sebelum mulai mencatat penjualan,
            masukkan nama usaha Anda.
        </p>

        <?php if (session()->getFlashdata('error')) : ?>

            <div class="alert">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>

        <form action="<?= site_url('business/store') ?>" method="post">

            <?= csrf_field() ?>

            <label for="name">
                Nama Usaha
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?= old('name') ?>"
                placeholder="Contoh: Khassava"
                required
                autofocus
            >

            <button type="submit">
                Simpan & Lanjutkan
            </button>

        </form>

    </div>

</div>

</body>
</html>