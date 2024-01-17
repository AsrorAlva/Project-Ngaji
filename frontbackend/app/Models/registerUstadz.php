<?php

namespace App\Models;

use CodeIgniter\Model;

class UstadzModel extends Model
{
    protected $table = 'ustadz';
    protected $allowedFields = ['ustadzID', 'username', 'password', 'email', 'nama', 'noTlpn'];
}
