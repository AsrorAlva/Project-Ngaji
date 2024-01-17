<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UstadzModel;
use App\Models\adminModel;

class AuthController extends BaseController
{
    use ResponseTrait;

    protected $format = 'json';

    public function userLogin()
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
        ];

        $user = $userModel->where('username', $data['username'])->first();

        if (!$user || $data['password'] != $user['password']) {
            return $this->failUnauthorized('Login Failed, Invalid username or password');
        }

        return $this->respond([
            'message' => 'Login successful',
            'user' => $user
        ]);
    }

    public function ustadzLogin()
    {
        $UstadzModel = new UstadzModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
        ];

        $ustadz = $UstadzModel->where('username', $data['username'])->first();

        if (!$ustadz || $data['password'] != $ustadz['password']) {
            return $this->failUnauthorized('Login Failed, Invalid username or password');
        }

        return $this->respond([
            'message' => 'Login successful',
            'ustadz' => $ustadz
        ]);
    }

    //get data user
    public function getUser()
    {
        $userModel = new UserModel();
        $user = $userModel->findAll(); // Mengambil semua data admin dari database

        return $this->respond($user); // Mengembalikan daftar admin sebagai respons
    }

    //get data user perid
    public function getUserr($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id); // Mengambil semua data admin dari database

        return $this->respond($user); // Mengembalikan daftar admin sebagai respons
    }

    //edit data user
    public function editUser($userID = null)
    {
        $userModel = new UserModel();

        // Mendapatkan data dari body permintaan (request body)
        $input = $this->request->getJSON();

        // Mengambil data dari input JSON
        $data = [
            'nama' => $input->nama,
            'username' => $input->username,
            'password' => $input->password,
            'email' => $input->email
        ];

        // Mengecek apakah userID yang dimaksud ada di database
        $userData = $userModel->find($userID);
        if (!$userData) {
            return $this->respond(['message' => 'User not found'], 404);
        }

        // Melakukan pembaruan data user berdasarkan userID
        $userModel->update($userID, $data);

        // Mengambil data user yang telah diperbarui
        $updatedUser = $userModel->find($userID);

        return $this->respond($updatedUser);
    }


    //delete user 
    public function delete($id = null)
    {
        $userModel = new UserModel();

        // Temukan user berdasarkan ID
        $user = $userModel->find($id);

        if ($user) {
            // Hapus user
            $userModel->delete($id);

            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        }
        // else {
        //     return $this->respondNotFound([
        //         'status' => 'error',
        //         'message' => 'User not found',
        //     ]);
        // }
    }


    //get data Ustadz

    public function getUstadz()
    {
        $ustadzModel = new UstadzModel();
        $ustadz = $ustadzModel->findAll();

        return $this->respond($ustadz);
    }

    //buat akun ustadz
    public function createUstadz()
    {
        $ustadzModel = new UstadzModel();

        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'noTlpn' => $this->request->getVar('noTlpn'), // Pastikan untuk melakukan enkripsi jika diperlukan sebelum menyimpan ke database
            // Sesuaikan dengan kolom-kolom yang ada pada tabel admin
        ];

        $created = $ustadzModel->insert($data);

        if ($created) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Admin created successfully']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Failed to create admin'], 500);
        }
    }

    //get akun ustadz perid
    public function getUstadzz($id)
    {
        $ustadzModel = new UstadzModel();
        $user = $ustadzModel->find($id); // Mengambil semua data admin dari database

        return $this->respond($user); // Mengembalikan daftar admin sebagai respons
    }

    // edit akun ustadz
    public function editustadz($id = null)
    {
        $ustadzModel = new UstadzModel();

        // Mendapatkan data dari body permintaan (request body)
        $input = $this->request->getJSON();

        // Mengambil data dari input JSON
        $data = [
            'nama' => $input->nama,
            'username' => $input->username,
            'email' => $input->email,
            'password' => $input->password,
            'noTlpn' => $input->noTlpn
            
        ];

        // Mengecek apakah userID yang dimaksud ada di database
        $ustadzData = $ustadzModel->find($id);
        if (!$ustadzData) {
            return $this->respond(['message' => 'User not found'], 404);
        }

        // Melakukan pembaruan data user berdasarkan userID
        $ustadzModel->update($id, $data);

        // Mengambil data user yang telah diperbarui
        $updatedAdmin = $ustadzModel->find($id);

        return $this->respond($updatedAdmin);
    }

    //delete akun Ustadz
    public function deleteUstadz($id = null)
    {
        $ustadModel = new UstadzModel();

        // Temukan user berdasarkan ID
        $user = $ustadModel->find($id);

        if ($user) {
            // Hapus user
            $ustadModel->delete($id);

            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        }
        // else {
        //     return $this->respondNotFound([
        //         'status' => 'error',
        //         'message' => 'User not found',
        //     ]);
        // }
    }



    // create Admin

    public function createAdmin()
    {
        $adminModel = new AdminModel();

        $data = [
            'namaAdmin' => $this->request->getVar('namaAdmin'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'), // Pastikan untuk melakukan enkripsi jika diperlukan sebelum menyimpan ke database
            // Sesuaikan dengan kolom-kolom yang ada pada tabel admin
        ];

        $created = $adminModel->insert($data);

        if ($created) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Admin created successfully']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Failed to create admin'], 500);
        }
    }

    //get admin id
    public function getAdmin($id)
    {
        $adminModel = new adminModel();
        $user = $adminModel->find($id); // Mengambil semua data admin dari database

        return $this->respond($user); // Mengembalikan daftar admin sebagai respons
    }



    //update Admin
    public function editadmin($adminID = null)
    {
        $adminModel = new adminModel();

        // Mendapatkan data dari body permintaan (request body)
        $input = $this->request->getJSON();

        // Mengambil data dari input JSON
        $data = [
            'namaAdmin' => $input->namaAdmin,
            'email' => $input->email,
            'password' => $input->password
            
        ];

        // Mengecek apakah userID yang dimaksud ada di database
        $adminData = $adminModel->find($adminID);
        if (!$adminData) {
            return $this->respond(['message' => 'User not found'], 404);
        }

        // Melakukan pembaruan data user berdasarkan userID
        $adminModel->update($adminID, $data);

        // Mengambil data user yang telah diperbarui
        $updatedAdmin = $adminModel->find($adminID);

        return $this->respond($updatedAdmin);
    }

    //hapus akun admin 

    public function deleteAdmin($adminID = null)
    {
        $adminModel = new adminModel();

        // Temukan user berdasarkan ID
        $user = $adminModel->find($adminID);

        if ($user) {
            // Hapus user
            $adminModel->delete($adminID);

            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        }
        // else {
        //     return $this->respondNotFound([
        //         'status' => 'error',
        //         'message' => 'User not found',
        //     ]);
        // }
    }

}
