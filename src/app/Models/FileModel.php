<?php
namespace App\Models;
use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'file';

    public function getFiles()
    {
        return $this->findAll();
    }
}
