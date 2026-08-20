<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $customerModel = new CustomerModel();

        $customers = $customerModel
            ->where('business_id', session()->get('business_id'))
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('master/customer/index', [
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('master/customer/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $name = trim((string) $this->request->getPost('name'));
        $phone = trim((string) $this->request->getPost('phone'));

        if ($name === '') {
            return redirect()
                ->to('/customers/create')
                ->withInput()
                ->with('error', 'Nama pelanggan wajib diisi.');
        }

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'business_id' => session()->get('business_id'),
            'name'        => $name,
            'phone'       => $phone !== '' ? $phone : null,
        ]);

        return redirect()
            ->to('/customers')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }
}