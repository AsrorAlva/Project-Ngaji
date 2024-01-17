<?php

namespace App\Models;

use CodeIgniter\Model;

class materiModel extends Model
{
    protected $table = 'materividio';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul_vidio', 'vidio_data', 'tanggal_upload'];

    // Tambahkan method atau fungsi lain jika diperlukan
}


