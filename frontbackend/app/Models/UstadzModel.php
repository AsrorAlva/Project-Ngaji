<?php

namespace App\Models;

use CodeIgniter\Model;

class UstadzModel extends Model
{
    protected $table = 'ustadz';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'username', 'email', 'password', 'noTlpn'];

    // Tambahkan method atau fungsi lain jika diperlukan
}
