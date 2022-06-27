<?php

namespace App\Http\Controllers;

use App\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController
{
    public function index($msg = null)
    {
        return view('contact.contact-form-simple', [
            'msg' => $msg
        ]);
    }

    public function profile()
    {
        return view('contact.user-profile2');
    }

    public function prices()
    {
        return view('contact.pricing');
    }

    public function imprint()
    {
        return view('imprint');
    }

    public function post(Request $request)
    {
        $message = new Message($request["contact"], $request["message"]);
        Mail::send($message);
        return $this->index("Danke für deine Nachricht");
    }
}
