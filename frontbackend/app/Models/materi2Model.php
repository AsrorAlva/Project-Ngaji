<?php

namespace App\Models;

use CodeIgniter\Model;

class materi2Model extends Model
{
    protected $table = 'materipenjelasan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'isipenjelasan', 'tanggal_upload'];

    // Tambahkan method atau fungsi lain jika diperlukan
}


