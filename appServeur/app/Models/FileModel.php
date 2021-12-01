<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'smartassos.users';

    public function getFiles()
    {
        return $this->findAll();
    }
}
