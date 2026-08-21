<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= esc($business['name'] ?? 'Dashboard') ?>
        - Sales Dashboard
    </title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->include('components/app_head') ?>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
        }

        body {
            margin: 0;
            background: #f5f7fa;
            color: #111827;
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        button,
        select {
            font-family: inherit;
        }


        /* ==========================================
           PAGE
        ========================================== */

        .page {
            width: 100%;
            min-height: 100vh;
            padding: 14px;
            padding-bottom: 28px;
        }

        .container {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
        }


        /* ==========================================
           HEADER
        ========================================== */

        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .business {
            margin-bottom: 3px;
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
        }

        h1 {
            margin: 0;
            font-size: 23px;
            line-height: 1.2;
            letter-spacing: -0.4px;
        }

        .welcome {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.4;
        }

        .logout {
            flex-shrink: 0;
            color: #dc2626;
            text-decoration: none;
            font-size: 12px;
            padding: 5px 0;
        }


        /* ==========================================
           PERIOD BADGE
        ========================================== */

        .period-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 9px;
            padding: 5px 9px;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            color: #2563eb;
            font-size: 10px;
            font-weight: 700;
        }

        .period-dot {
            width: 6px;
            height: 6px;
            background: #2563eb;
            border-radius: 50%;
        }


        /* ==========================================
           CARD
        ========================================== */

        .card {
            min-width: 0;
            padding: 15px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
        }

        .card-title {
            margin: 0;
            color: #111827;
            font-size: 15px;
            line-height: 1.3;
            font-weight: 750;
        }

        .card-subtitle {
            margin: 4px 0 14px;
            color: #9ca3af;
            font-size: 11px;
            line-height: 1.4;
        }


        /* ==========================================
           SALES INSIGHT
        ========================================== */

        .insight-card {
            margin-bottom: 14px;
        }

        .insight-list {
            display: grid;
            gap: 8px;
        }

        .insight {
            padding: 11px 12px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            color: #374151;
            font-size: 12px;
            line-height: 1.55;
        }

        .insight-period {
            margin-bottom: 9px;
            color: #6b7280;
            font-size: 10px;
        }

        .insight-period strong {
            color: #111827;
        }


        /* ==========================================
           KPI
        ========================================== */

        .kpi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .kpi-card {
            min-width: 0;
            padding: 15px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
        }

        .kpi-card.primary {
            grid-column: 1 / -1;
            padding: 18px;
            background: #111827;
            border-color: #111827;
            color: #ffffff;
        }

        .kpi-label {
            color: #6b7280;
            font-size: 11px;
            font-weight: 600;
        }

        .primary .kpi-label {
            color: #d1d5db;
        }

        .kpi-value {
            margin-top: 6px;
            color: #111827;
            font-size: 21px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .primary .kpi-value {
            margin-top: 7px;
            color: #ffffff;
            font-size: 29px;
        }


        /* ==========================================
           CHANNEL
        ========================================== */

        .channel-card {
            margin-bottom: 14px;
        }

        .channel-list {
            display: grid;
            gap: 14px;
        }

        .channel-item {
            min-width: 0;
        }

        .channel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 6px;
        }

        .channel-name {
            min-width: 0;
            overflow: hidden;
            color: #374151;
            font-size: 13px;
            font-weight: 650;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .channel-value {
            flex-shrink: 0;
            color: #111827;
            font-size: 12px;
            font-weight: 750;
        }

        .channel-bar {
            width: 100%;
            height: 7px;
            overflow: hidden;
            background: #eef2f7;
            border-radius: 99px;
        }

        .channel-progress {
            height: 100%;
            background: #2563eb;
            border-radius: 99px;
        }

        .channel-meta {
            margin-top: 5px;
            color: #9ca3af;
            font-size: 10px;
        }


        /* ==========================================
           PRODUCTS
        ========================================== */

        .products-card {
            margin-bottom: 14px;
        }

        .product-list {
            display: grid;
            gap: 0;
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .product-item:first-child {
            padding-top: 2px;
        }

        .product-item:last-child {
            border-bottom: 0;
            padding-bottom: 2px;
        }

        .product-rank {
            flex: 0 0 26px;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border-radius: 8px;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            flex: 1;
        }

        .product-name-wrap {
            min-width: 0;
        }

        .product-name {
            overflow: hidden;
            color: #374151;
            font-size: 12px;
            line-height: 1.45;
            font-weight: 650;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-sales {
            margin-top: 3px;
            color: #6b7280;
            font-size: 11px;
        }

        .product-qty {
            flex-shrink: 0;
            color: #6b7280;
            font-size: 11px;
            white-space: nowrap;
        }


        /* ==========================================
           FILTER
        ========================================== */

        .filter-card {
            margin-bottom: 14px;
            padding: 13px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
        }

        .filter-header {
            margin-bottom: 11px;
        }

        .filter-title {
            margin: 0;
            color: #111827;
            font-size: 13px;
            font-weight: 750;
        }

        .filter-description {
            margin: 3px 0 0;
            color: #9ca3af;
            font-size: 10px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 9px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
        }

        select {
            width: 100%;
            height: 43px;
            padding: 0 11px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
            background: #ffffff;
            color: #111827;
            font-size: 14px;
        }

        select:focus {
            border-color: #2563eb;
        }

        .filter-button {
            width: 100%;
            height: 43px;
            border: 0;
            border-radius: 9px;
            background: #2563eb;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .filter-button:active {
            transform: scale(.99);
        }


        /* ==========================================
           CHART
        ========================================== */

        .chart-card {
            margin-bottom: 14px;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 230px;
        }

        #salesTrendChart {
            max-width: 100%;
        }


        /* ==========================================
           SALES ACTIONS
        ========================================== */

        .actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 9px;
            margin-top: 14px;
            margin-bottom: 24px;
        }

        .action {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
        }

        .action-primary {
            background: #2563eb;
            color: #ffffff;
        }

        .action-secondary {
            background: #ffffff;
            border: 1px solid #dbe3ef;
            color: #2563eb;
        }


        /* ==========================================
           FULL NAVIGATION
        ========================================== */

        .main-nav {
            display: grid;
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
            gap: 9px;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e5e7eb;
        }

        .nav-card {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            min-height: 58px;
            padding: 11px 12px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            color: #111827;
            text-decoration: none;
            transition:
                transform 0.1s ease,
                border-color 0.1s ease;
        }

        .nav-card:hover {
            border-color: #cbd5e1;
        }

        .nav-card:active {
            transform: scale(0.98);
        }

        .nav-icon {
            flex: 0 0 34px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border-radius: 9px;
            color: #2563eb;
            font-size: 18px;
            line-height: 1;
        }

        .nav-content {
            min-width: 0;
        }

        .nav-title {
            color: #111827;
            font-size: 13px;
            font-weight: 750;
            line-height: 1.3;
        }

        .nav-description {
            margin-top: 2px;
            overflow: hidden;
            color: #9ca3af;
            font-size: 10px;
            line-height: 1.3;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nav-card.logout-card {
            border-color: #fee2e2;
        }

        .nav-card.logout-card .nav-icon {
            background: #fef2f2;
            color: #dc2626;
        }

        .nav-card.logout-card .nav-title {
            color: #dc2626;
        }


        /* ==========================================
           TABLET
        ========================================== */

        @media (min-width: 600px) {

            .page {
                padding: 20px;
            }

            .filter-form {
                grid-template-columns:
                    1fr 1fr;
            }

            .filter-button {
                grid-column: 1 / -1;
            }

            .kpi-grid {
                grid-template-columns:
                    2fr 1fr 1fr;
            }

            .kpi-card.primary {
                grid-column: auto;
            }

            .actions {
                grid-template-columns:
                    1fr 1fr;
            }

            .main-nav {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        /* ==========================================
           DESKTOP
        ========================================== */

        @media (min-width: 900px) {

            .page {
                padding: 30px 24px;
            }

            .header {
                margin-bottom: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .welcome {
                font-size: 14px;
            }

            .filter-card {
                padding: 15px;
            }

            .filter-form {
                grid-template-columns:
                    1fr 1fr 1fr auto;
                align-items: end;
            }

            .filter-button {
                grid-column: auto;
                padding: 0 24px;
            }

            .kpi-grid {
                grid-template-columns:
                    2fr 1fr 1fr 1fr;
            }

            .chart-container {
                height: 280px;
            }

            .card {
                padding: 18px;
            }

            .main-nav {
                grid-template-columns:
                    repeat(6, minmax(0, 1fr));
                gap: 8px;
            }

            .nav-card {
                min-height: 82px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 7px;
                padding: 10px 7px;
                text-align: center;
            }

            .nav-icon {
                flex: 0 0 34px;
            }

            .nav-content {
                width: 100%;
            }

            .nav-title {
                font-size: 11px;
            }

            .nav-description {
                font-size: 9px;
            }

        }
    </style>

</head>


<body>

    <?= $this->include('components/top_navbar') ?>

    <div class="page">

        <div class="container">


            <!-- ==========================================
                 HEADER
            =========================================== -->

            <header class="card-custom border-0 p-4 p-md-4 mb-4 shadow-sm bg-gradient-header">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1-5 font-weight-semibold d-inline-flex align-items-center gap-1">
                                <i class="bi bi-building"></i> <?= esc($business['name'] ?? '') ?>
                            </span>
                            <span class="badge bg-light text-secondary border rounded-pill px-3 py-1-5 font-weight-normal d-inline-flex align-items-center gap-1">
                                <span class="period-dot me-1"></span>
                                <?php if ($period === 'monthly') : ?>
                                    Periode: <?= esc($month_name) ?> <?= esc($year) ?>
                                <?php else : ?>
                                    Periode: Tahun <?= esc($year) ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <h1 class="h3 fw-bold text-dark tracking-tight mb-1">
                            Sales Dashboard
                        </h1>
                        <p class="text-muted small mb-0">
                            Halo, <span class="fw-semibold text-dark"><?= esc($session['user_name'] ?? '') ?></span>. Berikut ringkasan performa & insight penjualan usaha Anda.
                        </p>
                    </div>
                </div>
            </header>


            <!-- ==========================================
         1. SALES INSIGHT
    =========================================== -->

            <section class="card insight-card">

                <h2 class="card-title">
                    Sales Insight
                </h2>

                <p class="card-subtitle">
                    Ringkasan otomatis berdasarkan akumulasi periode
                </p>


                <div class="insight-period">

                    Data yang digunakan:

                    <strong>

                        <?php if ($period === 'monthly') : ?>

                            <?= esc($month_name) ?>
                            <?= esc($year) ?>

                        <?php else : ?>

                            Januari -
                            Desember
                            <?= esc($year) ?>

                        <?php endif; ?>

                    </strong>

                </div>


                <div class="insight-list">

                    <?php if (!empty($insights)) : ?>

                        <?php foreach ($insights as $insight) : ?>

                            <div class="insight">

                                <?= $insight ?>

                            </div>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <div class="insight">

                            Belum tersedia insight untuk periode ini.

                        </div>

                    <?php endif; ?>

                </div>

            </section>


            <!-- ==========================================
         2. KPI
    =========================================== -->

            <section class="kpi-grid">


                <div class="kpi-card primary">

                    <div class="kpi-label">
                        Total Penjualan
                    </div>

                    <div class="kpi-value">

                        Rp
                        <?= number_format(
                            (float) $kpi['total_sales'],
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                </div>


                <div class="kpi-card">

                    <div class="kpi-label">
                        Transaksi
                    </div>

                    <div class="kpi-value">

                        <?= number_format(
                            $kpi['total_transactions'],
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                </div>


                <div class="kpi-card">

                    <div class="kpi-label">
                        Produk Terjual
                    </div>

                    <div class="kpi-value">

                        <?= number_format(
                            $kpi['total_quantity'],
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                </div>


                <div class="kpi-card">

                    <div class="kpi-label">
                        Customer
                    </div>

                    <div class="kpi-value">

                        <?= number_format(
                            $kpi['total_customers'],
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                </div>

            </section>


            <!-- ==========================================
         3. PENJUALAN PER CHANNEL
    =========================================== -->

            <section class="card channel-card">

                <h2 class="card-title">
                    Penjualan per Channel
                </h2>

                <p class="card-subtitle">
                    Akumulasi kontribusi setiap channel pada periode terpilih
                </p>


                <?php

                $maxChannelSales = 0;
                $hasChannelSales = false;

                foreach ($channels as $channel) {

                    $value =
                        (float) $channel['total_sales'];

                    if ($value > $maxChannelSales) {
                        $maxChannelSales = $value;
                    }

                    if ($value > 0) {
                        $hasChannelSales = true;
                    }
                }

                ?>


                <?php if ($hasChannelSales) : ?>

                    <div class="channel-list">

                        <?php foreach ($channels as $channel) : ?>

                            <?php

                            $channelSales =
                                (float) $channel['total_sales'];

                            if ($channelSales <= 0) {
                                continue;
                            }

                            $percentage =
                                $kpi['total_sales'] > 0
                                ? (
                                    $channelSales
                                    / $kpi['total_sales']
                                ) * 100
                                : 0;

                            $barWidth =
                                $maxChannelSales > 0
                                ? (
                                    $channelSales
                                    / $maxChannelSales
                                ) * 100
                                : 0;

                            ?>

                            <div class="channel-item">

                                <div class="channel-header">

                                    <span class="channel-name">

                                        <?= esc(
                                            $channel['channel_name']
                                        ) ?>

                                    </span>

                                    <span class="channel-value">

                                        Rp
                                        <?= number_format(
                                            $channelSales,
                                            0,
                                            ',',
                                            '.'
                                        ) ?>

                                    </span>

                                </div>


                                <div class="channel-bar">

                                    <div
                                        class="channel-progress"
                                        style="
                                    width:
                                    <?= $barWidth ?>%;
                                "></div>

                                </div>


                                <div class="channel-meta">

                                    <?= number_format(
                                        $percentage,
                                        1,
                                        ',',
                                        '.'
                                    ) ?>%

                                    ·

                                    <?= number_format(
                                        (int)
                                        $channel['total_transactions'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                    transaksi

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else : ?>

                    <div class="insight">

                        Belum ada penjualan pada periode ini.

                    </div>

                <?php endif; ?>

            </section>


            <!-- ==========================================
         4. PRODUK TERATAS
    =========================================== -->

            <section class="card products-card">

                <h2 class="card-title">
                    Produk Teratas
                </h2>

                <p class="card-subtitle">
                    Top 5 berdasarkan akumulasi nilai penjualan
                </p>


                <?php

                $hasProducts = false;

                foreach ($products as $product) {

                    if (
                        (float) $product['total_sales'] > 0
                    ) {

                        $hasProducts = true;

                        break;
                    }
                }

                ?>


                <?php if ($hasProducts) : ?>

                    <div class="product-list">

                        <?php

                        $rank = 1;

                        foreach ($products as $product) :

                            if (
                                (float)
                                $product['total_sales']
                                <= 0
                            ) {
                                continue;
                            }

                        ?>

                            <div class="product-item">

                                <div class="product-info">

                                    <div class="product-rank">

                                        <?= $rank ?>

                                    </div>


                                    <div class="product-name-wrap">

                                        <div class="product-name">

                                            <?= esc(
                                                $product['product_name']
                                            ) ?>

                                        </div>

                                        <div class="product-sales">

                                            Rp
                                            <?= number_format(
                                                (float)
                                                $product['total_sales'],
                                                0,
                                                ',',
                                                '.'
                                            ) ?>

                                        </div>

                                    </div>

                                </div>


                                <div class="product-qty">

                                    <?= number_format(
                                        (float)
                                        $product['total_quantity'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                    unit

                                </div>

                            </div>


                        <?php

                            $rank++;

                        endforeach;

                        ?>

                    </div>

                <?php else : ?>

                    <div class="insight">

                        Belum ada penjualan produk.

                    </div>

                <?php endif; ?>

            </section>


            <!-- ==========================================
         5. FILTER
    =========================================== -->

            <section class="filter-card">

                <div class="filter-header">

                    <h2 class="filter-title">
                        Filter Periode
                    </h2>

                    <p class="filter-description">
                        Pilih periode untuk melihat akumulasi performa penjualan.
                    </p>

                </div>


                <form
                    method="get"
                    action="<?= site_url('home') ?>"
                    class="filter-form">

                    <div class="filter-group">

                        <label for="period">
                            Periode
                        </label>

                        <select
                            name="period"
                            id="period">

                            <option
                                value="monthly"
                                <?= $period === 'monthly'
                                    ? 'selected'
                                    : '' ?>>
                                Bulanan
                            </option>

                            <option
                                value="yearly"
                                <?= $period === 'yearly'
                                    ? 'selected'
                                    : '' ?>>
                                Tahunan
                            </option>

                        </select>

                    </div>


                    <div class="filter-group">

                        <label for="year">
                            Tahun
                        </label>

                        <select
                            name="year"
                            id="year">

                            <?php for (
                                $y = date('Y');
                                $y >= 2020;
                                $y--
                            ) : ?>

                                <option
                                    value="<?= $y ?>"
                                    <?= $year == $y
                                        ? 'selected'
                                        : '' ?>>
                                    <?= $y ?>
                                </option>

                            <?php endfor; ?>

                        </select>

                    </div>


                    <div
                        class="filter-group"
                        id="month-filter">

                        <label for="month">
                            Bulan
                        </label>

                        <select
                            name="month"
                            id="month">

                            <?php

                            $months = [
                                1  => 'Januari',
                                2  => 'Februari',
                                3  => 'Maret',
                                4  => 'April',
                                5  => 'Mei',
                                6  => 'Juni',
                                7  => 'Juli',
                                8  => 'Agustus',
                                9  => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ];

                            ?>


                            <?php foreach (
                                $months as $number => $name
                            ) : ?>

                                <option
                                    value="<?= $number ?>"
                                    <?= $month == $number
                                        ? 'selected'
                                        : '' ?>>
                                    <?= $name ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <button
                        type="submit"
                        class="filter-button">
                        Tampilkan
                    </button>

                </form>

            </section>


            <!-- ==========================================
         6. GRAFIK TREND PENJUALAN
    =========================================== -->

            <section class="card chart-card">

                <h2 class="card-title">
                    Trend Penjualan
                </h2>

                <p class="card-subtitle">

                    <?php if ($period === 'monthly') : ?>

                        Pergerakan penjualan harian selama
                        <?= esc($month_name) ?>
                        <?= esc($year) ?>

                    <?php else : ?>

                        Pergerakan penjualan bulanan selama tahun
                        <?= esc($year) ?>

                    <?php endif; ?>

                </p>


                <div class="chart-container">

                    <canvas id="salesTrendChart"></canvas>

                </div>

            </section>


            <!-- ==========================================
         7. SALES ACTIONS
    =========================================== -->

            <div class="actions">

                <a
                    href="<?= site_url('sales/input') ?>"
                    class="action action-primary">
                    + Catat Penjualan
                </a>


                <a
                    href="<?= site_url('sales/history') ?>"
                    class="action action-secondary">
                    Riwayat Penjualan
                </a>

            </div>




        </div>

    </div>


    <script>
        /* ==========================================
       SALES TREND CHART
    ========================================== */

        const trendLabels =
            <?= json_encode(
                $trend_labels,
                JSON_UNESCAPED_UNICODE
            ) ?>;


        const trendValues =
            <?= json_encode(
                $trend_values
            ) ?>;


        const currencyFormat =
            new Intl.NumberFormat(
                'id-ID'
            );


        new Chart(

            document.getElementById(
                'salesTrendChart'
            ),

            {

                type: 'line',

                data: {

                    labels: trendLabels,

                    datasets: [

                        {

                            label: 'Penjualan',

                            data: trendValues,

                            tension: 0.35,

                            fill: true,

                            borderWidth: 2,

                            pointRadius: 2.5,

                            pointHoverRadius: 5

                        }

                    ]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,


                    interaction: {

                        intersect: false,

                        mode: 'index'

                    },


                    plugins: {

                        legend: {

                            display: false

                        },


                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return 'Rp ' +
                                        currencyFormat
                                        .format(
                                            context
                                            .parsed
                                            .y
                                        );

                                }

                            }

                        }

                    },


                    scales: {

                        x: {

                            grid: {

                                display: false

                            },

                            ticks: {

                                maxTicksLimit: 8,

                                font: {

                                    size: 10

                                }

                            }

                        },


                        y: {

                            beginAtZero: true,

                            ticks: {

                                maxTicksLimit: 5,

                                font: {

                                    size: 10

                                },

                                callback: function(value) {

                                    return 'Rp ' +
                                        currencyFormat
                                        .format(
                                            value
                                        );

                                }

                            }

                        }

                    }

                }

            }

        );


        /* ==========================================
           MONTH FILTER
        ========================================== */

        const periodSelect =
            document.getElementById(
                'period'
            );


        const monthFilter =
            document.getElementById(
                'month-filter'
            );


        function updateMonthFilter() {

            if (
                periodSelect.value === 'yearly'
            ) {

                monthFilter.style.display =
                    'none';

            } else {

                monthFilter.style.display =
                    'block';

            }

        }


        periodSelect.addEventListener(
            'change',
            updateMonthFilter
        );


        updateMonthFilter();
    </script>

    <?= $this->include('components/bottom_nav') ?>

</body>

</html>