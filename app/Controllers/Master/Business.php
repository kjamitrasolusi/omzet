<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use Config\Database;

class Business extends BaseController
{
    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('master/business/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $name = trim((string) $this->request->getPost('name'));

        if ($name === '') {
            return redirect()
                ->to('/business/create')
                ->withInput()
                ->with('error', 'Nama usaha wajib diisi.');
        }

        $db = Database::connect();

        $db->query(
            'INSERT INTO app.businesses (owner_id, name)
             VALUES (?, ?)',
            [
                session()->get('user_id'),
                $name,
            ]
        );

        $businessId = $db->insertID();

        session()->set([
            'business_id' => $businessId,
        ]);

        return redirect()->to('/home');
    }
}