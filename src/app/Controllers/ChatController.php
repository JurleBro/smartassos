<?php
namespace App\Controllers;
use App\Models\ChatModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    public function index() {
        $model = model(ChatModel::class);
        echo view('chat', ['messages' => $model->getMessages()]);
    }

    public function saveChat($pseudo, $msg) {
        $model = model(ChatModel::class);
        $res = $model->saveChat(['pseudo' => $pseudo, 'msg' => $msg]);
        return json_encode($res);
    }
}
