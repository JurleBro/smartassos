<?php
namespace App\Controllers;
use App\Models\ChatModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    public function index($idGrp = 1) {
        $db = \Config\Database::connect();
        //$db->query('drop table chat');
        $db->query('create table if not exists chat ( id bigint unsigned auto_increment, grp varchar(10) null, msg varchar(250) null, pseudo varchar(250) null, constraint id unique (id))');

        $model = model(ChatModel::class);
        echo view('chat', ['messages' => $model->getMessages($idGrp), 'idGrp' => $idGrp]);
    }

    public function saveChat($grp, $pseudo, $msg) {
        $model = model(ChatModel::class);
        $res = $model->saveChat(['pseudo' => $pseudo, 'msg' => $msg, 'grp' => $grp]);
        return json_encode($res);
    }
}
