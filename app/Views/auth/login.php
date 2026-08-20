<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Omzet Insight</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px 22px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand h1 {
            margin: 0 0 8px;
            font-size: 24px;
            font-weight: 700;
        }

        .brand p {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #2563eb;
        }

        .btn-login {
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

        .btn-login:active {
            transform: scale(0.99);
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .footer {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: #9ca3af;
        }

        @media (min-width: 768px) {
            .login-card {
                padding: 40px;
            }

            .brand h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <div class="brand">
            <h1>Omzet Insight</h1>
            <p>Kelola penjualan. Pahami pelanggan.</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= old('email') ?>"
                    placeholder="Masukkan email"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

        </form>

    </div>

    <div class="footer">
        UMKM Sales Insight
    </div>

</div>

</body>
</html>