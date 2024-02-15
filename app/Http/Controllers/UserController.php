<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public static function show(Request $request)
  {  
    $user = User::where(
       ['id' => $request->input()['user_id']]
    )->get()->first();  
     
    return view('pages/user_profile', ['user' => $user]);
  }
}
