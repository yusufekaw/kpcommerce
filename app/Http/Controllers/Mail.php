<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class Mail extends Controller
{
    //
    public function basic_email() 
    {
        $data = array('name'=>"Yusuf Eka");

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('cuper.merch@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
            $message->from('yusufeka@djohancapital.co.id','Yusuf Eka');
        });
        echo "Basic Email Sent. Check your inbox.";
   }

   public function html_email() 
   {
        $data = array('name'=>'TEST');
        Mail::send('toko.mail.register', $data, function($message) {
            $message->to('yusuf.eka001@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
            $message->from('ucup.smtp@gmail.com','yusuf eka');
        });
        echo "HTML Email Sent. Check your inbox.";
   }

   public function attachment_email() 
   {
        $data = array('name'=>"Yusuf Eka");
        Mail::send('mail', $data, function($message) {
            $message->to('cuper.merch@gmail.com', 'Tutorials Point')->subject('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('yusufeka@djohancapital.co.id','yusuf eka');
        });
      echo "Email Sent with attachment. Check your inbox.";
   }

}
