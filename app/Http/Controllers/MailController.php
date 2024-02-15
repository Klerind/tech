<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
  public static function send(Request $request)
  {
    //dd($request);
    Mail::to('klerindtervoli@klerindtervoli.tech')->send(new SendMail($request));
      //  ->later(now()->addMinutes(10), new SendMail($request));
    return view('pages/contact');
  }
}
