<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Mail extends Controller
{

    public function index()
    {
        return view('mail');
    }

    function sendMail() {
        $to = $this->request->getVar('mailTo');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');

        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('eeverest023@gmail.com', 'SmartAssos');

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send())
        {
            echo 'Email successfully sent';
            return view('mail');
        }
        else
        {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

}
