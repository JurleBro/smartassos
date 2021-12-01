<?php
namespace App\Controllers;
use App\Models\FileModel;
use CodeIgniter\Controller;

class FileUpload extends Controller
{

    public function index()
	{
        $model = model(FileModel::class);

	    $data = ['files' => $model->getFiles()];
        return view('upload_file', $data);
    }

    function upload() {
        helper(['form', 'url']);

        $database = \Config\Database::connect();
        $db = $database->table('smartassos.users');

        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,100000]',
            ]
        ]);

        if (!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');

            $data = [
               'name' =>  $img->getName(),
               'type'  => $img->getClientMimeType()
            ];

            $save = $db->insert($data);
        }
    }

    function upload_ajax() {
        move_uploaded_file($_FILES['file']['tmp_name'], WRITEPATH.'uploads\\'. $_FILES['file']['name']);
        $database = \Config\Database::connect();
        $db = $database->table('smartassos.users');

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
                ->download(WRITEPATH . 'uploads\\' . $fileName, null)
                ->setFileName($fileName);
        } else {
            echo 'Ce fichier n\'exite pas';
            redirect(base_url('file'));
        }
    }

}
