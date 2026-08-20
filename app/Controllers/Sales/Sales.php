<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\ChannelModel;

class Sales extends BaseController
{
    public function history()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()
                ->to('/login')
                ->with('error', 'Business belum dipilih.');
        }

        $saleModel = new SaleModel();

        $from = $this->request->getGet('from');
        $to   = $this->request->getGet('to');

        if (!$from) {
            $from = date('Y-m-01');
        }

        if (!$to) {
            $to = date('Y-m-d');
        }

        $sales = $saleModel
            ->select(
                'sales.*,
                products.name AS product_name,
                customers.name AS customer_name,
                channels.name AS channel_name'
            )
            ->join(
                'products',
                'products.id = sales.product_id'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id',
                'left'
            )
            ->join(
                'channels',
                'channels.id = sales.channel_id',
                'left'
            )
            ->where(
                'sales.business_id',
                $businessId
            )
            ->where(
                'sales.transaction_date >=',
                $from
            )
            ->where(
                'sales.transaction_date <=',
                $to
            )
            ->orderBy(
                'sales.transaction_date',
                'DESC'
            )
            ->orderBy(
                'sales.id',
                'DESC'
            )
            ->findAll();

        $totalSales = 0;
        $totalQuantity = 0;

        foreach ($sales as $sale) {

            $totalSales +=
                (float) $sale['amount'];

            $totalQuantity +=
                (float) $sale['quantity'];
        }

        return view(
            'sales/history',
            [
                'sales' => $sales,

                'from' => $from,

                'to' => $to,

                'total_sales' =>
                    $totalSales,

                'total_quantity' =>
                    $totalQuantity,

                'total_transactions' =>
                    count($sales),
            ]
        );
    }
}