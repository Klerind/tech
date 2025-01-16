<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\UserRole;
use App\Models\UserLikedAccounts;
use App\Models\UserLanguages;
use App\Models\Roles;
use App\Models\Status;
use App\Models\Accounts;
use App\Models\Languages; 
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public static function show(Request $request)
  { 
    $user_id = intval($request->input()['user_id']);
      
    if ($user_id <= 0) 
    { 
        return redirect('/')->with('status', 'You can not use that user id!');
    }
    
    $user = User::where(
       ['id' => $user_id]
    )->get()->first();  
   
    if (is_null($user)) 
    { 
        return redirect('/')->with('status', 'This user is not in database!');
    }
    
    $user = new UserResource($user);
    //dd($user->linkedAccounts);
    //return $user->linkedAccounts[0]->accountName;
    return view('pages/user_profile', ['user' => $user]);
  } 
      
  public static function update(Request $request)
  {  
    $userData = json_decode($request->input()['data']);
      
    //dd($userData);
            
     $data["user_name"] = $userData->user_name;
     $data["user_description"] = $userData->user_description;
     $data["user_address"] = $userData->user_address;        
    
     $validator = Validator::make($data, [
            'user_name' => 'required|string|max:255',
            'user_description' => 'required|string|max:255',
            'user_address' => 'required|string|max:255',
        ]);
     
    if ($validator->fails())
    {
        
       $validated = $validator->errors(); 
       
       $validated = $validated->messages(); 
       
       return [ 
	     "user_status" => 'Error',
         "user_name" => isset($validated['user_name']) ? $validated['user_name'][0] : '', 
         "user_description" => isset($validated['user_description']) ? $validated['user_description'][0] : '', 
	     "user_address" => isset($validated['user_address']) ? $validated['user_address'][0] : '',
        ];
       
    }
     
    User::where(
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
    
    foreach ($userData->user_roles as $role_id)
    {
       $will_delete_user_role = UserRole::where([
           'user_id' => $userData->user_id,
           'role_id' => $role_id]
           );
       
       if(!is_null($will_delete_user_role))
       {
          $will_delete_user_role->delete();
       }
    }
    
    if(!empty($userData->new_user_roles))
    {
        foreach($userData->new_user_roles as $role_name)
        {  
           $role = Roles::firstOrCreate(['role' => $role_name]);    
           
           $user_role = UserRole::create([
                            'user_id' => $userData->user_id,
                            'role_id' => $role->role_id]);  
        } 
    }
      
    foreach ($userData->user_statuses as $status_id)
    {
       $will_delete_user_status = UserStatus::where([
           'user_id' => $userData->user_id,
           'status_id' => $status_id]
           );
       
       if(!is_null($will_delete_user_status))
       {
          $will_delete_user_status->delete();
       }
    }
         
    if(!empty($userData->new_user_statuses))
    {
        foreach($userData->new_user_statuses as $status_name)
        {  
           $status = Status::firstOrCreate(['status' => $status_name]);    
           
           $user_status = UserStatus::create([
                            'user_id' => $userData->user_id,
                            'status_id' => $status->status_id]);  
           //dd($user_role); 
        } 
    }
    
    foreach ($userData->user_languages as $language_id)
    {
       $will_delete_user_language = UserLanguages::where([
           'user_id' => $userData->user_id,
           'language_id' => $language_id]
           );
       
       if(!is_null($will_delete_user_language))
       {
          $will_delete_user_language->delete();
       }
    } 
      
    if(!empty($userData->new_user_languages))
    {
        foreach($userData->new_user_languages as $language_name)
        {  
           $language = Languages::firstOrCreate(['language' => $language_name]);    
           
           UserLanguages::firstOrCreate([
                            'user_id' => $userData->user_id,
                            'language_id' => $language->language_id]);   
        } 
    }
    
    foreach ($userData->user_linked_accounts as $linked_account_id)
    {
       $will_delete_user_linked_account = UserLikedAccounts::where([
           'user_id' => $userData->user_id,
           'liked_account_id' => $linked_account_id]
           );
        
       if(!is_null($will_delete_user_linked_account))
       {
          $will_delete_user_linked_account->delete();
       }
    }
     
    if(!empty($userData->new_user_linked_accounts))
    {
        foreach($userData->new_user_linked_accounts as $linked_account_name)
        {  
           $linked_account = Accounts::firstOrCreate(['account' => $linked_account_name]);    
         
           UserLikedAccounts::firstOrCreate([
                            'user_id' => $userData->user_id,
                            'liked_account_id' => $linked_account->account_id]);   
        } 
    } 
    
    return [
	   "user_status" => 'User Updated', 
        ];
  }
  
}
