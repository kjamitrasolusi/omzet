<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar - UMKM Sales Insight</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f7fa;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }


        .page {
            width: 100%;
            min-height: 100vh;
            padding: 20px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .container {
            width: 100%;
            max-width: 420px;
        }


        .header {
            margin-bottom: 20px;
            text-align: center;
        }


        .brand {
            margin-bottom: 10px;
            font-size: 22px;
            font-weight: 700;
        }


        h1 {
            margin: 0;
            font-size: 24px;
        }


        .subtitle {
            margin: 7px 0 0;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }


        .card {
            padding: 20px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }


        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 14px;
            line-height: 1.4;
        }


        .form-group {
            margin-bottom: 17px;
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


        .submit-button {
            width: 100%;
            min-height: 50px;
            margin-top: 4px;
            border: 0;
            border-radius: 11px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }


        .submit-button:active {
            transform: scale(0.99);
        }


        .login-link {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }


        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }


        .login-link a:hover {
            text-decoration: underline;
        }


        @media (min-width: 768px) {

            .card {
                padding: 28px;
            }

        }

    </style>

</head>


<body>


<div class="page">


    <div class="container">


        <!-- HEADER -->

        <div class="header">

            <div class="brand">
                UMKM Sales Insight
            </div>

            <h1>
                Buat Akun
            </h1>

            <p class="subtitle">
                Mulai kelola penjualan usaha Anda
            </p>

        </div>


        <!-- CARD -->

        <div class="card">


            <?php if (
                session()->getFlashdata('error')
            ) : ?>


                <div class="alert">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>


            <?php endif; ?>


            <form
                method="post"
                action="<?= site_url('register/create') ?>"
            >


                <?= csrf_field() ?>


                <!-- NAMA -->

                <div class="form-group">


                    <label for="name">
                        Nama
                    </label>


                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= esc(
                            old('name')
                        ) ?>"
                        placeholder="Nama Anda"
                        autocomplete="name"
                        required
                    >


                </div>


                <!-- EMAIL -->

                <div class="form-group">


                    <label for="email">
                        Email
                    </label>


                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= esc(
                            old('email')
                        ) ?>"
                        placeholder="nama@email.com"
                        autocomplete="email"
                        required
                    >


                </div>


                <!-- PASSWORD -->

                <div class="form-group">


                    <label for="password">
                        Password
                    </label>


                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        required
                    >


                </div>


                <!-- KONFIRMASI -->

                <div class="form-group">


                    <label for="password_confirm">
                        Konfirmasi Password
                    </label>


                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >


                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="submit-button"
                >
                    Daftar
                </button>


            </form>


            <!-- LOGIN -->

            <div class="login-link">

                Sudah punya akun?

                <a href="<?= site_url('login') ?>">
                    Masuk
                </a>

            </div>


        </div>


    </div>


</div>


</body>

</html>