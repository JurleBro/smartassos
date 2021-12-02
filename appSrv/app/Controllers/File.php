<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Model\FileModel;

class File extends Controller
{

    public function index()
    {
        $db = \Config\Database::connect();

        $db->query('create table if not exists file ( id bigint unsigned auto_increment, name varchar(100) not null , type varchar(255) not null, constraint id unique (id))');

        $model = model(FileModel::class);

        $data = ['files' => $model->getFiles()];

        return view('file', $data);
    }

    function upload_ajax() {
        move_uploaded_file($_FILES['file']['tmp_name'], WRITEPATH.'uploads/'. $_FILES['file']['name']);
        $database = \Config\Database::connect();
        $db = $database->table('file');

        $data = [
            'name' =>  $_FILES['file']['name'],
            'type'  => $_FILES['file']['type']
        ];

        $save = $db->insert($data);
        if($save) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }

    }

    public function download($fileName = NULL) {
        if ($fileName) {
            return $this
                ->response
                ->download(WRITEPATH . 'uploads/' . $fileName, null)
                ->setFileName($fileName);
        } else {
            echo 'Ce fichier n\'exite pas';
            redirect(base_url('file'));
        }
    }
}
