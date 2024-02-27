<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use App\Mail\Welcome;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\UserFormFieldController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FieldsGroupController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\ImagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class PagesController extends Controller
{

  public function getHome()
  {
    $fields = UserFormFieldController::show();
    $fields_content = ContentController::getContentsForHomePage();

    $posts = array();

    foreach ($fields_content['fields_content'] as $key => $item)
    {
      $posts[$item['content_link']][$key] = $item; //dump($item['content_link']);
    }

    //ksort($posts, SORT_NUMERIC);
//dd($posts);
    $products = array();

    foreach ($fields_content['fields_content'] as $key => $item)
    {
      $products[$item['content_link']][$key] = $item;
    }

    //ksort($products, SORT_NUMERIC);
   // dd($fields_content['contents']);
    return view('pages/welcome',[
           'fields' => $fields,
           'contents' => $fields_content['contents'],
           'posts' => $posts,
           'products' => $products
    ]);

  }

  public  function getAbout()
  {  
     $data = ScraperController::show();
     return view('pages/about',[
       'data' => $data
     ]);
  }

  public  function getContact()
  {
  //  Mail::to('laravelmail@lara000.in')->send(new SendMail());
    return view('pages/contact');
  }

  public  function sendMail()
  {
  //  Mail::to('laravelmail@lara000.in')->send(new SendMail());
    return view('pages/contact');
  }

  public function getProfilePage()
  {
     $widgets = WidgetController::show();
     $fields = UserFormFieldController::show();
     $fields_content = ContentController::show();
     $images = ImagesController::show();

     $contents = array();

     foreach ($fields_content['fields_content'] as $key => $item)
     {
       $contents[$item['content_link']][$key] = $item;
     }

     $posts = array();

     foreach ($fields_content['field_group_post'] as $key => $item)
     {
       $posts[$item['content_link']][$key] = $item;
     }

     ksort($posts, SORT_NUMERIC);

     $products = array();

     foreach ($fields_content['field_group_product'] as $key => $item)
     {
       $products[$item['content_link']][$key] = $item;
     }

     ksort($products, SORT_NUMERIC);

     return view('pages/profile', [
         'widgets' => $widgets,
         'fields' => $fields,
         'contents' => $contents,
         'posts' => $posts,
         'products' => $products,
         'images' => $images
     ]);
  }

  public function createArticleForm(Request $request)
  {
     $requests = $request->input();
     FormFieldController::store($requests);

     return redirect('/profile');
  }

  public function createContent(Request $request)
  {
      ContentController::create($request);

      return redirect('/profile');
   }

   public function imagesUpload(Request $request)
   {
     dd($request->file('image')->getClientOriginalName());
     $imgOriginName = $request->file('image')->getClientOriginalName();
     ImagesController::store($imgOriginName);
     $request->image->move(public_path('public_html'), $imgOriginName);
     return redirect('/profile');
   }

}
