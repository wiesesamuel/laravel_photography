<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mailgun\Mailgun;

class ContactController
{
    public function index($msg = null)
    {
        return view('contact.contact-form-simple', [
            'msg' => $msg
        ]);
    }

    public function post(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'contact'=>'required|email'
//        ]);
//        if ($validator->fails()) {
//            $validator = Validator::make($request->all(), [
//                'contact'=>'required|digits'
//            ]);
//        }

        Mail::create([
            "contact" => $request["contact"],
            "message" => $request["message"]
        ]);
        $this->messageToMyself($request);
        return $this->index("Deine Nachricht wurde zugestellt, ich melde mich bald.");
    }

    private function messageToMyself(Request $request)
    {
        $this->sendMail(
            config('app.name') . " new Message via Form",
            $request["contact"] . '<br>' . $request["message"]
        );
    }

    public function sendMail($subject = null, $msg = null)
    {
        if (config('mail.enabled')) {
            if ($subject != null || $msg != null) {

                # Instantiate the client.
                $mg = Mailgun::create(config('mail.mailers.mailgun.api-key'));
                $domain = config('mail.mailers.mailgun.domain');

                # Make the call to the client.
                $result = $mg->messages()->send("$domain",
                    array('from' => config('mail.from.name') . ' <postmaster@' . config('mail.mailers.mailgun.domain') . '>',
                        'to' => config('mail.to.name') . ' <' . config('mail.to.address') . '>',
                        'subject' => $subject ?? 'Hello ' . config('mail.to.name'),
                        'text' => $msg ?? 'Info'));
            }
        }
    }
}
