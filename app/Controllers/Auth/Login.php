<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Database;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/home');
        }

        return view('auth/login');
    }


    public function authenticate()
    {
        /*
         * ==========================================
         * INPUT
         * ==========================================
         */

        $email = trim(
            (string) $this->request->getPost('email')
        );

        $password = (string) $this->request->getPost(
            'password'
        );


        /*
         * ==========================================
         * VALIDASI INPUT
         * ==========================================
         */

        if ($email === '' || $password === '') {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'error',
                    'Email dan password wajib diisi.'
                );
        }


        /*
         * ==========================================
         * CARI USER
         * ==========================================
         */

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->first();


        /*
         * ==========================================
         * USER TIDAK DITEMUKAN
         * ==========================================
         */

        if (!$user) {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'error',
                    'Email atau password salah.'
                );
        }


        /*
         * ==========================================
         * VERIFIKASI PASSWORD
         * ==========================================
         */

        if (
            !password_verify(
                $password,
                $user['password_hash']
            )
        ) {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'error',
                    'Email atau password salah.'
                );
        }


        /*
         * ==========================================
         * CARI BUSINESS
         * ==========================================
         *
         * Relasi:
         *
         * app.users.id
         *        ↓
         * app.businesses.owner_id
         *
         */

        $db = Database::connect();

        $business = $db
            ->table('app.businesses')
            ->where(
                'owner_id',
                $user['id']
            )
            ->get()
            ->getRowArray();


        /*
         * ==========================================
         * REGENERATE SESSION
         * ==========================================
         */

        session()->regenerate(true);


        /*
         * ==========================================
         * SIMPAN SESSION USER
         * ==========================================
         */

        session()->set([
            'logged_in'  => true,
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
        ]);


        /*
         * ==========================================
         * BUSINESS BELUM ADA
         * ==========================================
         *
         * User sudah berhasil login,
         * tetapi belum mempunyai business.
         *
         * Jangan dianggap sebagai login gagal.
         *
         * Arahkan ke onboarding business.
         */

        if (!$business) {

            return redirect()
                ->to('/business/create');
        }


        /*
         * ==========================================
         * SIMPAN BUSINESS SESSION
         * ==========================================
         */

        session()->set([
            'business_id'   => $business['id'],
            'business_name' => $business['name'],
        ]);


        /*
         * ==========================================
         * LOGIN BERHASIL
         * ==========================================
         */

        return redirect()->to('/home');
    }


    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Anda telah keluar dari aplikasi.'
            );
    }
}