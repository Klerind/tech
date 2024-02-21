<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\UserRole;

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
     // dd($userData);
       
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
    //dd($userData->user_statuses);
    
    foreach ($userData->user_statuses as $status_id)
    {
       $check_if_user_status_exists = UserStatus::where([
           'user_id' => $userData->user_id,
           'status_id' => $status_id]
           )->get()->first();
       if(!$check_if_user_status_exists)
       {
          UserStatus::create([
            'user_id' => $userData->user_id,
            'status_id' => $status_id]);  
       }
      // dd($check_if_user_status_exists);
    }
    
    foreach ($userData->user_roles as $role_id)
    {
       $check_if_user_status_exists = UserRole::where([
           'user_id' => $userData->user_id,
           'role_id' => $role_id]
           )->get()->first();
       if(!$check_if_user_status_exists)
       {
          UserRole::create([
            'user_id' => $userData->user_id,
            'role_id' => $role_id]);  
       }
      // dd($check_if_user_status_exists);
    }
    
    //$user->role()->updateOrCreate([
    //    'user_id' => $userData->user_id,
    //    'role_id' => 2]);     
    
    $user = User::where(
       ['id' => $userData->user_id]
    )->get()->first();  
     dd($user);
    return view('pages/user_profile', ['user' => $user]);
  }
  
}
