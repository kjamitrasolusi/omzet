<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pelanggan - UMKM Sales Insight</title>

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

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 22px;
        }

        .subtitle {
            margin: 0 0 24px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
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
            height: 48px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
        }

        button {
            width: 100%;
            height: 48px;
            border: 0;
            border-radius: 10px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="<?= site_url('customers') ?>" class="back">
        ← Kembali ke Pelanggan
    </a>

    <div class="card">

        <h1>Tambah Pelanggan</h1>

        <p class="subtitle">
            Tambahkan pelanggan yang melakukan pembelian.
        </p>

        <form action="<?= site_url('customers/store') ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">

                <label for="name">
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= old('name') ?>"
                    placeholder="Contoh: Budi"
                    autocomplete="name"
                    required
                >

            </div>

            <div class="form-group">

                <label for="phone">
                    Nomor HP
                </label>

                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="<?= old('phone') ?>"
                    placeholder="Contoh: 08123456789"
                    autocomplete="tel"
                >

            </div>

            <button type="submit">
                Simpan Pelanggan
            </button>

        </form>

    </div>

</div>

</body>
</html>