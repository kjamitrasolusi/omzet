<?php

namespace App\Controllers;

use Config\Database;

class Home extends BaseController
{
    public function index()
    {
        /*
         * ==========================================
         * AUTHENTICATION
         * ==========================================
         */

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()
                ->to('/login')
                ->with('error', 'Business tidak ditemukan.');
        }


        /*
         * ==========================================
         * FILTER
         *
         * Semua data dashboard menggunakan
         * periode yang sama:
         *
         * monthly = 1 bulan
         * yearly  = 1 tahun
         * ==========================================
         */

        $period = $this->request->getGet('period') ?: 'monthly';

        if (!in_array($period, ['monthly', 'yearly'], true)) {
            $period = 'monthly';
        }

        $year = (int) (
            $this->request->getGet('year')
            ?: date('Y')
        );

        $month = (int) (
            $this->request->getGet('month')
            ?: date('n')
        );

        if ($year < 2000 || $year > 2100) {
            $year = (int) date('Y');
        }

        if ($month < 1 || $month > 12) {
            $month = (int) date('n');
        }


        /*
         * ==========================================
         * DATABASE
         * ==========================================
         */

        $db = Database::connect();


        /*
         * ==========================================
         * BUSINESS
         * ==========================================
         */

        $business = $db->query(
            "
            SELECT
                id,
                name
            FROM app.businesses
            WHERE id = ?
            LIMIT 1
            ",
            [$businessId]
        )->getRowArray();


        /*
         * ==========================================
         * DASHBOARD DATE RANGE
         *
         * monthly:
         *   start = tanggal 1 bulan terpilih
         *   end   = tanggal 1 bulan berikutnya
         *
         * yearly:
         *   start = 1 Januari tahun terpilih
         *   end   = 1 Januari tahun berikutnya
         *
         * Semua query dashboard menggunakan range ini.
         * ==========================================
         */

        if ($period === 'monthly') {

            $startDate = sprintf(
                '%04d-%02d-01',
                $year,
                $month
            );

            $endDate = date(
                'Y-m-d',
                strtotime($startDate . ' +1 month')
            );

        } else {

            $startDate = sprintf(
                '%04d-01-01',
                $year
            );

            $endDate = sprintf(
                '%04d-01-01',
                $year + 1
            );
        }


        /*
         * ==========================================
         * KPI
         *
         * Semua KPI mengikuti periode dashboard.
         *
         * monthly = akumulasi 1 bulan
         * yearly  = akumulasi 1 tahun
         * ==========================================
         */

        $kpi = $db->query(
            "
            SELECT

                COALESCE(
                    SUM(amount),
                    0
                ) AS total_sales,

                COUNT(*) AS total_transactions,

                COALESCE(
                    SUM(quantity),
                    0
                ) AS total_quantity,

                COUNT(DISTINCT customer_id)
                    FILTER (
                        WHERE customer_id IS NOT NULL
                    ) AS total_customers

            FROM app.sales

            WHERE business_id = ?

              AND transaction_date >= ?

              AND transaction_date < ?
            ",
            [
                $businessId,
                $startDate,
                $endDate
            ]
        )->getRowArray();


        /*
         * ==========================================
         * SALES TREND
         *
         * monthly:
         *   penjualan dikelompokkan per tanggal
         *
         * yearly:
         *   penjualan dikelompokkan per bulan
         * ==========================================
         */

        if ($period === 'monthly') {

            $trend = $db->query(
                "
                SELECT

                    EXTRACT(
                        DAY FROM transaction_date
                    )::integer AS period_value,

                    COALESCE(
                        SUM(amount),
                        0
                    ) AS total_sales

                FROM app.sales

                WHERE business_id = ?

                  AND transaction_date >= ?

                  AND transaction_date < ?

                GROUP BY
                    EXTRACT(
                        DAY FROM transaction_date
                    )

                ORDER BY
                    period_value ASC
                ",
                [
                    $businessId,
                    $startDate,
                    $endDate
                ]
            )->getResultArray();

        } else {

            $trend = $db->query(
                "
                SELECT

                    EXTRACT(
                        MONTH FROM transaction_date
                    )::integer AS period_value,

                    COALESCE(
                        SUM(amount),
                        0
                    ) AS total_sales

                FROM app.sales

                WHERE business_id = ?

                  AND transaction_date >= ?

                  AND transaction_date < ?

                GROUP BY
                    EXTRACT(
                        MONTH FROM transaction_date
                    )

                ORDER BY
                    period_value ASC
                ",
                [
                    $businessId,
                    $startDate,
                    $endDate
                ]
            )->getResultArray();
        }


        /*
         * ==========================================
         * CHANNEL PERFORMANCE
         *
         * Menggunakan periode dashboard yang sama
         *
         * monthly = performa channel selama 1 bulan
         * yearly  = performa channel selama 1 tahun
         * ==========================================
         */

        $channels = $db->query(
            "
            SELECT

                ch.id,

                ch.name AS channel_name,

                COUNT(s.id)
                    AS total_transactions,

                COALESCE(
                    SUM(s.amount),
                    0
                ) AS total_sales

            FROM app.channels ch

            LEFT JOIN app.sales s

                ON s.channel_id = ch.id

                AND s.business_id = ch.business_id

                AND s.transaction_date >= ?

                AND s.transaction_date < ?

            WHERE ch.business_id = ?

            GROUP BY
                ch.id,
                ch.name

            ORDER BY
                total_sales DESC,
                ch.name ASC
            ",
            [
                $startDate,
                $endDate,
                $businessId
            ]
        )->getResultArray();


        /*
         * ==========================================
         * TOP PRODUCTS
         *
         * Menggunakan periode dashboard yang sama
         *
         * monthly = produk teratas selama 1 bulan
         * yearly  = produk teratas selama 1 tahun
         * ==========================================
         */

        $products = $db->query(
            "
            SELECT

                p.id,

                p.name AS product_name,

                COALESCE(
                    SUM(s.quantity),
                    0
                ) AS total_quantity,

                COALESCE(
                    SUM(s.amount),
                    0
                ) AS total_sales

            FROM app.products p

            LEFT JOIN app.sales s

                ON s.product_id = p.id

                AND s.business_id = p.business_id

                AND s.transaction_date >= ?

                AND s.transaction_date < ?

            WHERE p.business_id = ?

            GROUP BY
                p.id,
                p.name

            ORDER BY
                total_sales DESC,
                total_quantity DESC,
                p.name ASC

            LIMIT 5
            ",
            [
                $startDate,
                $endDate,
                $businessId
            ]
        )->getResultArray();


        /*
         * ==========================================
         * SALES INSIGHT
         *
         * Insight selalu membaca data pada
         * periode dashboard yang sama.
         * ==========================================
         */

        $totalSales = (float) (
            $kpi['total_sales'] ?? 0
        );


        /*
         * TOP CHANNEL
         * ==========================================
         */

        $topChannel = null;

        foreach ($channels as $channel) {

            if (
                (float) $channel['total_sales'] > 0
            ) {

                $topChannel = $channel;

                break;
            }
        }


        /*
         * TOP PRODUCT
         * ==========================================
         */

        $topProduct = null;

        foreach ($products as $product) {

            if (
                (float) $product['total_sales'] > 0
            ) {

                $topProduct = $product;

                break;
            }
        }


        /*
         * ==========================================
         * GENERATE INSIGHTS
         * ==========================================
         */

        $insights = [];


        /*
         * INSIGHT CHANNEL
         * ==========================================
         */

        if (
            $topChannel
            && $totalSales > 0
        ) {

            $channelSales =
                (float) $topChannel['total_sales'];

            $channelPercentage =
                (
                    $channelSales
                    / $totalSales
                ) * 100;

            $insights[] =
                'Channel <strong>'
                . esc(
                    $topChannel['channel_name']
                )
                . '</strong> menjadi channel penjualan '
                . 'terbesar dengan kontribusi '
                . number_format(
                    $channelPercentage,
                    1,
                    ',',
                    '.'
                )
                . '% dari total penjualan.';
        }


        /*
         * INSIGHT PRODUCT
         * ==========================================
         */

        if ($topProduct) {

            $insights[] =
                'Produk dengan penjualan tertinggi adalah '
                . '<strong>'
                . esc(
                    $topProduct['product_name']
                )
                . '</strong> dengan nilai penjualan Rp '
                . number_format(
                    (float)
                    $topProduct['total_sales'],
                    0,
                    ',',
                    '.'
                )
                . '.';
        }


        /*
         * INSIGHT EMPTY
         * ==========================================
         */

        if (empty($insights)) {

            $insights[] =
                'Belum ada transaksi pada periode yang '
                . 'dipilih. Mulai catat penjualan untuk '
                . 'mendapatkan insight bisnis.';
        }


        /*
         * ==========================================
         * TREND DATA UNTUK CHART
         * ==========================================
         */

        $trendLabels = [];

        $trendValues = [];


        /*
         * MONTHLY TREND
         * ==========================================
         */

        if ($period === 'monthly') {

            $daysInMonth = (int) date(
                't',
                strtotime($startDate)
            );


            $trendMap = [];


            foreach ($trend as $row) {

                $trendMap[
                    (int) $row['period_value']
                ] = (float) $row['total_sales'];
            }


            /*
             * Buat seluruh tanggal dalam bulan,
             * termasuk tanggal tanpa transaksi.
             */

            for (
                $day = 1;
                $day <= $daysInMonth;
                $day++
            ) {

                $trendLabels[] =
                    (string) $day;

                $trendValues[] =
                    $trendMap[$day] ?? 0;
            }


        /*
         * YEARLY TREND
         * ==========================================
         */

        } else {

            $months = [

                1  => 'Jan',
                2  => 'Feb',
                3  => 'Mar',
                4  => 'Apr',
                5  => 'Mei',
                6  => 'Jun',
                7  => 'Jul',
                8  => 'Agu',
                9  => 'Sep',
                10 => 'Okt',
                11 => 'Nov',
                12 => 'Des',

            ];


            $trendMap = [];


            foreach ($trend as $row) {

                $trendMap[
                    (int) $row['period_value']
                ] = (float) $row['total_sales'];
            }


            /*
             * Buat seluruh bulan dalam tahun,
             * termasuk bulan tanpa transaksi.
             */

            foreach (
                $months as $number => $name
            ) {

                $trendLabels[] =
                    $name;

                $trendValues[] =
                    $trendMap[$number] ?? 0;
            }
        }


        /*
         * ==========================================
         * MONTH NAME
         * ==========================================
         */

        $monthName = date(
            'F',
            strtotime($startDate)
        );


        /*
         * ==========================================
         * VIEW DATA
         * ==========================================
         */

        $data = [

            /*
             * BUSINESS
             * --------------------------------------
             */

            'business' => [

                'id' =>
                    $business['id']
                    ?? $businessId,

                'name' =>
                    $business['name']
                    ?? '',

            ],


            /*
             * SESSION
             * --------------------------------------
             */

            'session' => [

                'logged_in' =>
                    session()->get(
                        'logged_in'
                    ),

                'user_id' =>
                    session()->get(
                        'user_id'
                    ),

                'user_name' =>
                    session()->get(
                        'user_name'
                    ),

                'user_email' =>
                    session()->get(
                        'user_email'
                    ),

                'business_id' =>
                    $businessId,

            ],


            /*
             * FILTER
             * --------------------------------------
             */

            'period' =>
                $period,

            'year' =>
                $year,

            'month' =>
                $month,

            'month_name' =>
                $monthName,


            /*
             * KPI
             * --------------------------------------
             */

            'kpi' => [

                'total_sales' =>
                    (float) (
                        $kpi['total_sales']
                        ?? 0
                    ),

                'total_transactions' =>
                    (int) (
                        $kpi['total_transactions']
                        ?? 0
                    ),

                'total_quantity' =>
                    (float) (
                        $kpi['total_quantity']
                        ?? 0
                    ),

                'total_customers' =>
                    (int) (
                        $kpi['total_customers']
                        ?? 0
                    ),

            ],


            /*
             * TREND
             * --------------------------------------
             */

            'trend' =>
                $trend,

            'trend_labels' =>
                $trendLabels,

            'trend_values' =>
                $trendValues,


            /*
             * CHANNEL
             * --------------------------------------
             */

            'channels' =>
                $channels,


            /*
             * PRODUCTS
             * --------------------------------------
             */

            'products' =>
                $products,


            /*
             * INSIGHTS
             * --------------------------------------
             */

            'insights' =>
                $insights,

        ];


        /*
         * ==========================================
         * RENDER VIEW
         * ==========================================
         */

        return view(
            'home/index',
            $data
        );
    }
}