<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat';

    public function getMessages($idGrp) {
        return $this->where('grp', $idGrp)->get()->getResultArray();
    }

    public function saveChat($data)
    {
        return $this
            ->db
            ->table($this->table)
            ->insert($data);
    }
}
