<?php

namespace App\Models;

use CodeIgniter\Model;

    class adminModel extends Model
    {
        protected $table = 'admin';
        protected $primaryKey = 'adminID';
        protected $allowedFields = ['namaAdmin', 'email', 'password'];

        // Tambahkan method atau fungsi lain jika diperlukan
    }
