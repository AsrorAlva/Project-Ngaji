<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class RegisterController extends ResourceController
{
    use ResponseTrait;

    protected $format = 'json';
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function createUser()
    {
        $request = $this->request->getJSON();

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => ($request->password),
            'konfirmasi' => $request->konfirmasi,
        ];

        try {
            $this->userModel->insert($data);
            $response = [
                'status' => 200,
                'messages' => 'User registered successfully',
                'data' => $data,
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $response = [
                'status' => 500,
                'error' => $errorMessage,
                'messages' => 'Failed to register user',
            ];
            return $this->respond($response, 500);
        }
    }
}




// namespace App\Controllers;

// use CodeIgniter\RESTful\ResourceController;

// class registerController extends ResourceController
// {
//     protected $format = 'json';

//     public function index()
//     {
//         $userModel = new \App\Models\UserModel();
//         $ustadzModel = new \App\Models\UstadzModel();

//         $userData = $userModel->findAll();
//         $ustadzData = $ustadzModel->findAll();

//         $response = [
//             'status' => 'success',
//             'data' => [
//                 'users' => $userData,
//                 'ustadz' => $ustadzData
//             ]
//         ];

//         return $this->respond($response);
//     }

//     public function createUser()
//     {
//         $data = [
//             'nama' => $this->request->getVar('nama'),
//             'username' => $this->request->getVar('username'),
//             'email' => $this->request->getVar('email'),
//             'password' => $this->request->getVar('password'),
//             'konfirmasi' => $this->request->getVar('konfirmasi'),
//         ];

//         $userModel = new \App\Models\UserModel();
//         $userModel->save($data);

//         $response = [
//             'status' => 200,
//             'messages' => 'User data added successfully',
//             'data' => $data,
//         ];

//         return $this->respond($response);
//     }

//     public function createUstadz()
//     {
//         $data = [
//             'username' => $this->request->getVar('username'),
//             'password' => $this->request->getVar('password'),
//             'email' => $this->request->getVar('email'),
//             'namaUstadz' => $this->request->getVar('namaUstadz'),
//             'noTlpn' => $this->request->getVar('noTlpn'),
//         ];

//         $ustadzModel = new \App\Models\UstadzModel();
//         $ustadzModel->save($data);

//         $response = [
//             'status' => 200,
//             'messages' => 'Ustadz data added successfully',
//             'data' => $data,
//         ];

//         return $this->respond($response);
//     }

// }


// namespace App\Controllers;

// use CodeIgniter\API\ResponseTrait;
// use CodeIgniter\Controller;
// use App\Models\UserModel;
// use App\Models\UstadzModel;

// class RegisterController extends Controller
// {
//     use ResponseTrait;

//     public function register()
//     {
//         $request = service('request');
//         $data = $request->getJSON();
        
//         // Menangani data dari frontend
//         $nama = $data->nama;
//         $username = $data->username;
//         $email = $data->email;
//         $password = $data->password;
//         $userType = $data->userType;
//         $noTlpn = $data->noTlpn ?? null; // Jika 'ustadz', gunakan jika tidak, null

        // Validasi jenis pengguna
//         if ($userType === 'user' || $userType === 'ustadz') {
//             $model = ($userType === 'user') ? new UserModel() : new UstadzModel();

//             $userData = [
//                 'nama' => $nama,
//                 'username' => $username,
//                 'email' => $email,
//                 'password' => password_hash($password, PASSWORD_DEFAULT),
//                 'noTlpn' => $noTlpn // Jika null, tidak akan masuk ke dalam array
//             ];

//             $model->insert($userData);

//             $message = ($userType === 'user') ? 'User berhasil terdaftar' : 'Ustadz berhasil terdaftar';
//             return $this->respondCreated(['message' => $message]);
//         } else {
//             return $this->fail('Jenis pengguna tidak valid');
//         }
//     }
// }
