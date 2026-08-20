<?php

namespace App\Controllers\Sales;

use App\Controllers\BaseController;
use Config\Database;

class Edit extends BaseController
{
    /**
     * Menampilkan form edit transaksi
     */
    public function index($id = null)
    {
        /*
         * ==========================================
         * CHECK LOGIN
         * ==========================================
         */

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        /*
         * ==========================================
         * BUSINESS
         * ==========================================
         */

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Business belum ditemukan.'
                );
        }


        /*
         * ==========================================
         * VALIDATE ID
         * ==========================================
         */

        if (!$id || !is_numeric($id)) {
            return redirect()
                ->to('/sales/history')
                ->with(
                    'error',
                    'ID transaksi tidak valid.'
                );
        }


        /*
         * ==========================================
         * DATABASE
         * ==========================================
         */

        $db = Database::connect();


        /*
         * ==========================================
         * GET SALE
         * ==========================================
         */

        $sale = $db
            ->table('sales')
            ->where('id', $id)
            ->where('business_id', $businessId)
            ->get()
            ->getRowArray();


        /*
         * TRANSACTION NOT FOUND
         */

        if (!$sale) {
            return redirect()
                ->to('/sales/history')
                ->with(
                    'error',
                    'Transaksi tidak ditemukan.'
                );
        }


        /*
         * ==========================================
         * GET PRODUCTS
         * ==========================================
         */

        $products = $db
            ->table('products')
            ->where(
                'business_id',
                $businessId
            )
            ->orderBy(
                'name',
                'ASC'
            )
            ->get()
            ->getResultArray();


        /*
         * ==========================================
         * GET CUSTOMERS
         * ==========================================
         */

        $customers = $db
            ->table('customers')
            ->where(
                'business_id',
                $businessId
            )
            ->orderBy(
                'name',
                'ASC'
            )
            ->get()
            ->getResultArray();


        /*
         * ==========================================
         * GET CHANNELS
         * ==========================================
         */

        $channels = $db
            ->table('channels')
            ->where(
                'business_id',
                $businessId
            )
            ->orderBy(
                'name',
                'ASC'
            )
            ->get()
            ->getResultArray();


        /*
         * ==========================================
         * SEND TO VIEW
         * ==========================================
         */

        return view(
            'sales/edit',
            [
                'sale'      => $sale,
                'products'  => $products,
                'customers' => $customers,
                'channels'  => $channels
            ]
        );
    }


    /**
     * Menyimpan perubahan transaksi
     */
    public function update($id = null)
    {
        /*
         * ==========================================
         * CHECK LOGIN
         * ==========================================
         */

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        /*
         * ==========================================
         * BUSINESS
         * ==========================================
         */

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Business belum ditemukan.'
                );
        }


        /*
         * ==========================================
         * VALIDATE ID
         * ==========================================
         */

        if (!$id || !is_numeric($id)) {
            return redirect()
                ->to('/sales/history')
                ->with(
                    'error',
                    'ID transaksi tidak valid.'
                );
        }


        /*
         * ==========================================
         * INPUT
         * ==========================================
         */

        $transactionDate = trim(
            (string) $this->request->getPost(
                'transaction_date'
            )
        );

        $productId = $this->request->getPost(
            'product_id'
        );

        $quantity = $this->request->getPost(
            'quantity'
        );

        $amount = $this->request->getPost(
            'amount'
        );

        $customerId = $this->request->getPost(
            'customer_id'
        );

        $channelId = $this->request->getPost(
            'channel_id'
        );


        /*
         * ==========================================
         * BASIC VALIDATION
         * ==========================================
         */

        if (
            $transactionDate === '' ||
            !$productId ||
            $quantity === null ||
            $quantity === '' ||
            $amount === null ||
            $amount === ''
        ) {
            return redirect()
                ->to('/sales/edit/' . $id)
                ->withInput()
                ->with(
                    'error',
                    'Tanggal, produk, jumlah, dan nilai penjualan wajib diisi.'
                );
        }


        /*
         * ==========================================
         * NORMALIZE NUMBER
         * ==========================================
         */

        $quantity = (float) $quantity;

        $amount = (float) $amount;


        if ($quantity <= 0) {
            return redirect()
                ->to('/sales/edit/' . $id)
                ->withInput()
                ->with(
                    'error',
                    'Jumlah penjualan harus lebih dari 0.'
                );
        }


        if ($amount < 0) {
            return redirect()
                ->to('/sales/edit/' . $id)
                ->withInput()
                ->with(
                    'error',
                    'Nilai penjualan tidak valid.'
                );
        }


        /*
         * ==========================================
         * DATABASE
         * ==========================================
         */

        $db = Database::connect();


        /*
         * ==========================================
         * VERIFY SALE OWNERSHIP
         * ==========================================
         */

        $sale = $db
            ->table('sales')
            ->where(
                'id',
                $id
            )
            ->where(
                'business_id',
                $businessId
            )
            ->get()
            ->getRowArray();


        if (!$sale) {
            return redirect()
                ->to('/sales/history')
                ->with(
                    'error',
                    'Transaksi tidak ditemukan.'
                );
        }


        /*
         * ==========================================
         * VERIFY PRODUCT
         * ==========================================
         */

        $product = $db
            ->table('products')
            ->where(
                'id',
                $productId
            )
            ->where(
                'business_id',
                $businessId
            )
            ->get()
            ->getRowArray();


        if (!$product) {
            return redirect()
                ->to('/sales/edit/' . $id)
                ->withInput()
                ->with(
                    'error',
                    'Produk tidak ditemukan.'
                );
        }


        /*
         * ==========================================
         * VERIFY CUSTOMER
         * ==========================================
         */

        if (!empty($customerId)) {

            $customer = $db
                ->table('customers')
                ->where(
                    'id',
                    $customerId
                )
                ->where(
                    'business_id',
                    $businessId
                )
                ->get()
                ->getRowArray();


            if (!$customer) {
                return redirect()
                    ->to('/sales/edit/' . $id)
                    ->withInput()
                    ->with(
                        'error',
                        'Pelanggan tidak ditemukan.'
                    );
            }
        }


        /*
         * ==========================================
         * VERIFY CHANNEL
         * ==========================================
         */

        if (!empty($channelId)) {

            $channel = $db
                ->table('channels')
                ->where(
                    'id',
                    $channelId
                )
                ->where(
                    'business_id',
                    $businessId
                )
                ->get()
                ->getRowArray();


            if (!$channel) {
                return redirect()
                    ->to('/sales/edit/' . $id)
                    ->withInput()
                    ->with(
                        'error',
                        'Channel tidak ditemukan.'
                    );
            }
        }


        /*
         * ==========================================
         * UPDATE
         * ==========================================
         */

        $db
            ->table('sales')
            ->where(
                'id',
                $id
            )
            ->where(
                'business_id',
                $businessId
            )
            ->update([
                'transaction_date' => $transactionDate,
                'product_id'       => $productId,
                'customer_id'      => !empty($customerId)
                    ? $customerId
                    : null,
                'channel_id'       => !empty($channelId)
                    ? $channelId
                    : null,
                'quantity'         => $quantity,
                'amount'           => $amount,
                'updated_at'       => date(
                    'Y-m-d H:i:s'
                )
            ]);


        /*
         * ==========================================
         * SUCCESS
         * ==========================================
         */

        return redirect()
            ->to('/sales/history')
            ->with(
                'success',
                'Transaksi berhasil diperbarui.'
            );
    }
}