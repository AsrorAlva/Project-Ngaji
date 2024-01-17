<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\materiModel;
use App\Models\materi2Model;

class materiController extends BaseController
{
    use ResponseTrait;


    //materi vidio
    //baca untuk tabel admin
    public function getMateriVidio()
    {
        $materiModel = new materiModel();
        $materi = $materiModel->findAll();

        // Mengubah BLOB menjadi base64 untuk dikirimkan sebagai respons
        // foreach ($materi as &$item) {
        //     $item['vidio_data'] = base64_encode($item['vidio_data']);
        // }

        return $this->respond($materi);
    }




    //baca untuk tabel user (read)
    public function getMateriVidioUser($id)
    {
        $materiModel = new materiModel();
        $materi = $materiModel->find($id);

        if ($materi) {
            // $materi['vidio_data'] = base64_encode($materi['vidio_data']);
            return $this->respond($materi);
        } else {
            return $this->failNotFound('Video not found');
        }
    }


    //Create untuk tabel admin 
    public function uploadVideo()
    {
        $model = new materiModel();

        $judul_vidio = $this->request->getPost('judul_vidio');
        $tanggal_upload = $this->request->getPost('tanggal_upload');
        $vidio_data = $this->request->getFile('vidio_data');

        $data = [
            'judul_vidio' => $judul_vidio,
            'vidio_data' => $vidio_data->getName(),
            'tanggal_upload' => $tanggal_upload
        ];

        if ($model->save($data)) {
            $vidio_data->move(FCPATH . 'uploads', $vidio_data->getName());
            return $this->respondCreated(['message' => 'Video uploaded successfully']);
        } else {
            return $this->fail($model->errors());
        }
    }

    //edit vidio
    // pastikan ini adalah bagian dari kelas controller Anda
    public function editVideo($id)
    {
        $model = new MateriModel(); // Inisialisasi model

        $video = $model->find($id); // Temukan video berdasarkan ID

        if (!$video) {
            return $this->respond(["message" => "Video not found"], 404); // Video tidak ditemukan
        }

        $judul_vidio = $this->request->getVar('judul_vidio') ?? $video['judul_vidio'];
        $vidio_data = $this->request->getFile('vidio_data');

        $data = [
            'judul_vidio' => $judul_vidio
        ];

        if ($vidio_data && $vidio_data->isValid()) {
            if (!$vidio_data->hasMoved()) {
                $vidio_data->move(FCPATH . 'uploads', $vidio_data->getName());
            }
            $data['vidio_data'] = $vidio_data->getName();
        } else {
            $data['vidio_data'] = $video['vidio_data']; // Jika tidak ada file yang diunggah, gunakan data yang sudah ada
        }

        if ($model->update($id, $data)) {
            return $this->respond(["message" => "Video updated successfully", "data" => $data], 200);
        } else {
            return $this->respond(["message" => "Failed to update video"], 400);
        }
    }


    //delete vidio
    public function deleteVidio($id = null)
    {
        $model = new materiModel();

        // Temukan user berdasarkan ID
        $user = $model->find($id);

        if ($user) {
            // Hapus user
            $model->delete($id);

            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'Vidio deleted successfully',
            ]);
        }
        // else {
        //     return $this->respondNotFound([
        //         'status' => 'error',
        //         'message' => 'User not found',
        //     ]);
        // }
    }


    //materi penjelasan 
    //read tabel user

    public function getMateriPenjelasan($id)
    {
        $materi2Model = new materi2Model();
        $materi = $materi2Model->find($id);

        return $this->respond($materi);
    }

    // read tabel admin
    public function getMateriPenjelasann()
    {
        $materi2Model = new materi2Model();
        $materi = $materi2Model->findAll();

        return $this->respond($materi);
    }

    //create materi penjelasan
    public function CreateMateriPenjelasan()
    {
        $materi2Model = new materi2Model();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'isipenjelasan' => $this->request->getVar('isipenjelasan'),
            'tanggal_upload' => $this->request->getVar('tanggal_upload'), // Pastikan untuk melakukan enkripsi jika diperlukan sebelum menyimpan ke database
            // Sesuaikan dengan kolom-kolom yang ada pada tabel admin
        ];

        $created = $materi2Model->insert($data);
        if ($created) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Admin created successfully']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Failed to create admin'], 500);
        }
    }

    
    //edit materi penjelasan
    public function editMateriPenjelasan($id = null)
    {
        $materi2Model = new materi2Model();

        // Mendapatkan data dari body permintaan (request body)
        $input = $this->request->getJSON();

        // Mengambil data dari input JSON
        $data = [
            'judul' => $input->judul,
            'isipenjelasan' => $input->isipenjelasan,
            'tanggal_upload' => $input->tanggal_upload
            
        ];

        // Mengecek apakah userID yang dimaksud ada di database
        $adminData = $materi2Model->find($id);
        if (!$adminData) {
            return $this->respond(['message' => 'User not found'], 404);
        }

        // Melakukan pembaruan data user berdasarkan userID
        $materi2Model->update($id, $data);

        // Mengambil data user yang telah diperbarui
        $updatedAdmin = $materi2Model->find($id);

        return $this->respond($updatedAdmin);
    }

    //hapus materi
    public function deleteMateriPenjelasan($id = null)
    {
        $materi2Model = new materi2Model();

        // Temukan user berdasarkan ID
        $user = $materi2Model->find($id);

        if ($user) {
            // Hapus user
            $materi2Model->delete($id);

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
