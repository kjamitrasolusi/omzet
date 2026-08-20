<?php

namespace App\Controllers;

use App\Models\UserModel;
use Throwable;

class UserTest extends BaseController
{
    public function index()
    {
        try {
            $userModel = new UserModel();

            $user = $userModel
                ->orderBy('id', 'ASC')
                ->first();

            return $this->response->setJSON([
                'status' => 'success',
                'user' => $user,
            ]);

        } catch (Throwable $e) {

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                ]);
        }
    }
}