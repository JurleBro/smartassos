<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat';

    public function getMessages() {
        return $this->findAll();
    }

    public function saveChat($data)
    {
        return $this
            ->db
            ->table($this->table)
            ->insert($data);
    }
}
