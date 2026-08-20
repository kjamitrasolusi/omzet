<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();

        $products = $productModel
            ->where('business_id', session()->get('business_id'))
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('master/product/index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('master/product/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $name = trim((string) $this->request->getPost('name'));

        if ($name === '') {
            return redirect()
                ->to('/products/create')
                ->withInput()
                ->with('error', 'Nama produk wajib diisi.');
        }

        $productModel = new ProductModel();

        $productModel->insert([
            'business_id' => session()->get('business_id'),
            'name'        => $name,
        ]);

        return redirect()
            ->to('/products')
            ->with('success', 'Produk berhasil ditambahkan.');
    }
}