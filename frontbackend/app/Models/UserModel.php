<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userID';
    protected $allowedFields = ['nama', 'username', 'password', 'email'];

    // Tambahkan method atau fungsi lain jika diperlukan
}