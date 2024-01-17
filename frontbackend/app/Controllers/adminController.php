<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;
use App\Models\UstadzModel;

class adminController extends BaseController
{
    use ResponseTrait;

    protected $format = 'json';

    public function adminLogin()
    {
        $adminModel = new AdminModel();

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $admin = $adminModel->where('email', $data['email'])->first();

        if (!$admin || $data['password'] != $admin['password']) {
            return $this->failUnauthorized('Login Failed, Invalid email or password');
        }

        return $this->respond([
            'message' => 'Login successful',
            'admin' => $admin
        ]);
    }

    // GetAdmin

    public function getAdmins()
    {
        $adminModel = new AdminModel();
        $admins = $adminModel->findAll(); // Mengambil semua data admin dari database

        return $this->respond($admins); // Mengembalikan daftar admin sebagai respons
    }

    //Create Ustadz
    // public function createUstadz()
    // {
    //     $request = service('request');
    //     $model = new ustadzModel();

    //     $data = [
    //         'username' => $request->getVar('username'),
    //         'password' => $request->getVar('password'),
    //         'email' => $request->getVar('email'),
    //         'nama' => $request->getVar('nama'),
    //         'noTlpn' => $request->getVar('noTlpn')
    //         // Tambahkan data lain jika diperlukan
    //     ];

    //     $model->insert($data);

    //     return $this->respondCreated('Ustadz created successfully');
    // }
}
