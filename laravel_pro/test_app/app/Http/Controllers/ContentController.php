<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\User;
use App\Models\FormField;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
  public static function create(Request $request)
  {
    $inputs = $request->input();     
    if (!is_null($request->file('image')))
    {
      $imgOriginName = $request->file('image')->getClientOriginalName();
      $request->image->move(public_path(''), $imgOriginName);
      $inputs[28] = $imgOriginName;
    }
    
    $field_group = $inputs['field_group'];
    unset($inputs['field_group']);

    if (isset($inputs['_token']))
    {
     unset($inputs['_token']);
    } 
     
    $fields = FormField::whereIn('field_id', array_keys($inputs))->get();
       
    //dd($fields);
     
    //dd($inputs);
    //FormField::where([
    //    'field_id' => $inputs[0]$key
    //]);
    //$inputs['cmimi'] = null;
    //dd(array_keys($inputs));
     
    foreach ($fields as $field)
    {
          $rules[$field->name] = 'required';
          
          foreach ($inputs as $key => $value)
          {
              if($field->field_id === $key)
              {
                  $new_inputs[$field->name] = $value;
              }
          }
    }
       
    $validator = Validator::make($new_inputs, $rules,[
        'required' => 'The :attribute field is required.',
    ], [
    ]);
         //dd($validator->fails());
    if ($validator->fails()) 
    {
        //echo 'test';
        //dd(9);
        return redirect('/profile')
                                ->withErrors($validator);
     }  
     
    $random_number = mt_rand(1, 1000);

    $check_if_content_link_exists = Content::where(
     [
     'content_link' => $random_number
    ])->get()->first();

    if (isset($inputs['content_link']))
    {
      $content_link = $inputs['content_link'];
      unset($inputs['content_link']);

      foreach ($inputs as $key => $value)
      {
        $save = Content::where(
         [
         'user_id' => auth()->id(),
         'field_id' => $key,
         'field_group' => $field_group,
         'content_link' => $content_link
        ])->update(['content' => $value]);
      }

    } else
    {
      unset($inputs['content_link']);

    if (empty($check_if_content_link_exists))
    {
      foreach ($inputs as $key => $value)
      {  
       $save = Content::create(
         [
         'user_id' => auth()->id(),
         'field_id' => $key,
         'field_group' => $field_group,
         'content_link' => $random_number,
         'content' => $value
        ]);
      }
     }
    }

  }

  public static function show()
  { 
    $fields = $field_group_post = $field_group_product = [];
    $fields_content = Content::select('*')
        ->where(['user_id' => auth()->id()])
      //  ->whereIn('field_id', $field_id)
      //  ->orderBy('field_id', 'asc')
        ->get();

    foreach ($fields_content as $field_content)
    {
        if ($field_content['field_group'] === 1)
        {
          $field_group_post[] =  $field_content;
        }elseif ($field_content['field_group'] === 2)
        {
          $field_group_product[] =  $field_content;
        }
    }
    $fields['fields_content'] = $fields_content;
    $fields['field_group_post'] = $field_group_post;
    $fields['field_group_product'] = $field_group_product;

    return $fields;
  }
  
  public static function showArticle(Request $request)
  {   
    $content_link_id = intval($request->input()['content_link']); 
    
    if ($content_link_id <= 0) 
    { 
        return redirect('/')->with('status', 'You can not use that article id!');
    }
    
    $fields = $field_group_post = $field_group_product = [];
    $fields_content = Content::select('*')
        ->where(['content_link' => $content_link_id])
      //  ->whereIn('field_id', $field_id)
      //  ->orderBy('field_id', 'asc')
        ->get();

    foreach ($fields_content as $field_content)
    {
        if ($field_content['field_group'] === 1)
        {
          $field_group_post[] =  $field_content;
        }elseif ($field_content['field_group'] === 2)
        {
          $field_group_product[] =  $field_content;
        }
    }
    $fields['fields_content'] = $fields_content; 
     
    return view('pages/article',[
           'contents' => $fields_content
    ]); 
  } 

  public static function delete($content_id)
  {
    $deleted = Content::where([
      'content_id' => $content_id
     ])->delete();
  }

  public static function getContentsForSingelItem($content_id)
  {
    return Content::where(
       ['content_id' => $content_id]
     )->get()->first();
  }

  public static function getContentsForHomePage()
  {
    $fields_content = Content::orderBy('created_at', 'desc')->get();

    foreach ($fields_content as $key => $item)
    {
       $contents[$item['content_link']][$key] = $item; //dump($item['content_link']);
    }

    foreach ($fields_content as $field_content)
    {
        if ($field_content->field_group === 1)
        { //dump($field_content);
          $field_group_post[] =  $field_content;
        }
        if ($field_content->field_group === 2)
        {
          $field_group_product[] =  $field_content;
        }
    }
    $fields['contents'] = $contents;
    $fields['fields_content'] = $fields_content;
    $fields['field_group_post'] = $field_group_post;
    $fields['field_group_product'] = $field_group_product;
    //dd($fields_content);
    return $fields;
  }

  public function search(Request $request)
  {
      $request->validate([
          'search' => 'required'
      ]);
      
    $request = $request->input();

    $user = User::where(
           'name', 'LIKE', "%{$request['search']}%"
        )->get()->first();

      if (!is_null($user))
      {//dd($user);
        $contents = Content::where(
              'content', 'LIKE', "%{$request['search']}%"
           )
           ->orWhere('user_id', '=', $user->id)
           ->get();
      }else
      {
        $contents = Content::where(
              'content', 'LIKE', "%{$request['search']}%"
           )->get();
      }

     $all_contents = [];

     foreach ($contents as $content)
     {
       if (!is_null($content['content_link']) )
       {
         $all_contents[] = Content::where(
            ['content_link' => $content['content_link'] ]
          )->get();
       }
     }
 
     return view('pages/search', [
         'all_contents' => $all_contents
     ]);

  }

  public static function update($inputs)
  {
     $save = Content::where(
     [
     'content_id' => $inputs['content_id']
    ])->update(['content' => $inputs['content']]);
  }

}
