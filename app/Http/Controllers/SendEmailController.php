<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index(Request $request)
    {
        $array = array(
            "nama" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message
        );

        Mail::to($request->email)->send(new SendEmail($array));

        return redirect()->to('contact')->with('alert-success','Send Email Success!!');;
    }
}
