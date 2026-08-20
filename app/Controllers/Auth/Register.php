<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/home');
        }

        return view('auth/register');
    }


    public function create()
    {
        /*
         * ==========================================
         * INPUT
         * ==========================================
         */

        $name = trim(
            (string) $this->request->getPost('name')
        );

        $email = strtolower(
            trim(
                (string) $this->request->getPost('email')
            )
        );

        $password = (string) $this->request->getPost(
            'password'
        );

        $passwordConfirm = (string) $this->request->getPost(
            'password_confirm'
        );


        /*
         * ==========================================
         * VALIDASI
         * ==========================================
         */

        if (
            $name === '' ||
            $email === '' ||
            $password === '' ||
            $passwordConfirm === ''
        ) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Semua field wajib diisi.'
                );
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        if (strlen($password) < 8) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Password minimal 8 karakter.'
                );
        }


        if ($password !== $passwordConfirm) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi password tidak sama.'
                );
        }


        /*
         * ==========================================
         * USER MODEL
         * ==========================================
         */

        $userModel = new UserModel();


        /*
         * ==========================================
         * CEK EMAIL
         * ==========================================
         */

        $existingUser = $userModel
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Email sudah terdaftar.'
                );
        }


        /*
         * ==========================================
         * HASH PASSWORD
         * ==========================================
         *
         * Gunakan PASSWORD_DEFAULT agar kompatibel
         * langsung dengan password_verify() di Login.
         */

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        /*
         * ==========================================
         * PASTIKAN HASH BERHASIL
         * ==========================================
         */

        if ($passwordHash === false) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Password gagal diproses.'
                );
        }


        /*
         * ==========================================
         * INSERT USER
         * ==========================================
         */

        $userId = $userModel->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => $passwordHash
        ]);


        /*
         * ==========================================
         * INSERT FAILED
         * ==========================================
         */

        if (!$userId) {
            return redirect()
                ->to('/register')
                ->withInput()
                ->with(
                    'error',
                    'Registrasi gagal. Silakan coba lagi.'
                );
        }


        /*
         * ==========================================
         * SUCCESS
         * ==========================================
         */

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Akun berhasil dibuat. Silakan masuk.'
            );
    }
}