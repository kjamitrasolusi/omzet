<?php

namespace App\Controllers;

use Config\Database;

class Business extends BaseController
{
    /**
     * Business Profile
     */
    public function profile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');

        if (!$businessId) {
            return redirect()->to('/business/create');
        }

        $db = Database::connect();

        $business = $db
            ->table('app.businesses')
            ->where('id', $businessId)
            ->get()
            ->getRowArray();

        if (!$business) {
            session()->remove([
                'business_id',
                'business_name'
            ]);

            return redirect()
                ->to('/business/create')
                ->with(
                    'error',
                    'Business tidak ditemukan.'
                );
        }

        return view('business/profile', [
            'business' => $business
        ]);
    }


    /**
     * Update Business Profile
     */
    public function update()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $businessId = session()->get('business_id');
        $userId     = session()->get('user_id');

        if (!$businessId || !$userId) {
            return redirect()->to('/login');
        }

        $name = trim(
            (string) $this->request->getPost('name')
        );

        if ($name === '') {
            return redirect()
                ->to('/business/profile')
                ->withInput()
                ->with(
                    'error',
                    'Nama usaha wajib diisi.'
                );
        }

        $db = Database::connect();

        /*
         * Pastikan business memang milik
         * user yang sedang login.
         */
        $business = $db
            ->table('app.businesses')
            ->where('id', $businessId)
            ->where('owner_id', $userId)
            ->get()
            ->getRowArray();

        if (!$business) {
            return redirect()
                ->to('/home')
                ->with(
                    'error',
                    'Anda tidak memiliki akses ke business ini.'
                );
        }

        $db
            ->table('app.businesses')
            ->where('id', $businessId)
            ->where('owner_id', $userId)
            ->update([
                'name'       => $name,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        /*
         * Update session agar nama business
         * langsung berubah di seluruh aplikasi.
         */
        session()->set([
            'business_name' => $name
        ]);

        return redirect()
            ->to('/business/profile')
            ->with(
                'success',
                'Profil usaha berhasil diperbarui.'
            );
    }
}