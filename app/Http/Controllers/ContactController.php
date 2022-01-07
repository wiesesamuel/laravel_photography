<?php

namespace App\Http\Controllers;

use App\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController
{
    public function index($msg = null)
    {
        return view('contact.contact-form-simple', [
            'msg' => $msg
        ]);
    }

    public function profile() {
        return view('contact.user-profile2');
    }

    public function prices() {
        return view('contact.pricing');
    }

    public function post(Request $request)
    {
        $message = new Message($request["contact"], $request["message"]);
        Mail::send($message);
        return $this->index("Danke für deine Nachricht");
    }
}
