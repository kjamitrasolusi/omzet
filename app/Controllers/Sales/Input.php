<?php

namespace App\Controllers\Sales;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\ChannelModel;
use App\Models\SaleModel;

class Input extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        $productModel = new ProductModel();
        $customerModel = new CustomerModel();
        $channelModel = new ChannelModel();

        $products = $productModel
            ->where('business_id', $businessId)
            ->orderBy('name', 'ASC')
            ->findAll();

        $customers = $customerModel
            ->where('business_id', $businessId)
            ->orderBy('name', 'ASC')
            ->findAll();

        $channels = $channelModel
            ->where('business_id', $businessId)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('sales/input', [
            'products'  => $products,
            'customers' => $customers,
            'channels'  => $channels,
        ]);
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        $transactionDate = $this->request->getPost('transaction_date');
        $productId       = $this->request->getPost('product_id');
        $customerId      = $this->request->getPost('customer_id');
        $channelId       = $this->request->getPost('channel_id');
        $quantity        = $this->request->getPost('quantity');
        $amount          = $this->request->getPost('amount');

        if (
            empty($transactionDate) ||
            empty($productId) ||
            $quantity === null ||
            $quantity === '' ||
            $amount === null ||
            $amount === ''
        ) {
            return redirect()
                ->to('/sales/input')
                ->withInput()
                ->with('error', 'Data penjualan wajib dilengkapi.');
        }

        $saleModel = new SaleModel();

        $saleModel->insert([
            'business_id'      => $businessId,
            'transaction_date' => $transactionDate,
            'product_id'       => $productId,
            'customer_id'      => $customerId !== '' ? $customerId : null,
            'channel_id'       => $channelId !== '' ? $channelId : null,
            'quantity'         => $quantity,
            'amount'           => $amount,
        ]);

        return redirect()
            ->to('/sales/input')
            ->with('success', 'Penjualan berhasil disimpan.');
    }
}