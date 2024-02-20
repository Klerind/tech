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
  
  public static function update(Request $request)
  {  
    $userData = json_decode($request->input()['data']);
      dd($userData);
       
    $save = User::where(
     [
     'id' => $userData->user_id
    ])->update(['name' => $userData->user_name]);
    
    $user = User::where(
     [
     'id' => $userData->user_id
    ])->get()->first();
    
    if($user->description)
    {
      $user->description()->update([
        'user_id' => $userData->user_id,
        'user_description' => $userData->user_description]);
    }else
    {
      $user->description()->create([
        'user_id' => $userData->user_id,
        'user_description' => $userData->user_description]); 
    }
    
    if($user->address)
    {
      $user->address()->update([
        'user_id' => $userData->user_id,
        'address' => $userData->user_address]);
    }else
    {
      $user->address()->create([
        'user_id' => $userData->user_id,
        'address' => $userData->user_address]); 
    }
    
    $user->address()->updateOrCreate([
        'user_id' => $userData->user_id,
        'address' => $userData->user_address]);     
    
    $user = User::where(
       ['id' => $userData->user_id]
    )->get()->first();  
     dd($user);
    return view('pages/user_profile', ['user' => $user]);
  }
  
}
