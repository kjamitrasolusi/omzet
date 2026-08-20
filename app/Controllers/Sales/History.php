<?php

namespace App\Controllers\Sales;

use App\Controllers\BaseController;
use Config\Database;

class History extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()
                ->to('/login')
                ->with('error', 'Business belum ditemukan.');
        }

        $db = Database::connect();

        $sales = $db
            ->table('sales s')
            ->select(
                's.id,
                 s.transaction_date,
                 s.quantity,
                 s.amount,
                 p.name AS product_name,
                 c.name AS customer_name,
                 ch.name AS channel_name'
            )
            ->join(
                'products p',
                'p.id = s.product_id',
                'inner'
            )
            ->join(
                'customers c',
                'c.id = s.customer_id',
                'left'
            )
            ->join(
                'channels ch',
                'ch.id = s.channel_id',
                'left'
            )
            ->where(
                's.business_id',
                $businessId
            )
            ->orderBy(
                's.transaction_date',
                'DESC'
            )
            ->orderBy(
                's.id',
                'DESC'
            )
            ->get()
            ->getResultArray();

        return view('sales/history', [
            'sales' => $sales
        ]);
    }
}