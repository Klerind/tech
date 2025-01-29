<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
  public static function send(Request $request)
  {
      dd($request->cookie());
    $request->validate([
        'email' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:255'
    ]); 
    
    Mail::to('klerindtervoli@klerindtervoli.online')->send(new SendMail($request));
      //  ->later(now()->addMinutes(10), new SendMail($request));
     return redirect('/contact')->with('status', 'Your email was send!'); 
  }
}
