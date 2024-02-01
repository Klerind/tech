<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Images;

class ImagesController extends Controller
{

  public static function show()
  {
    return Images::where([
      'user_id' => auth()->id()
      ])->get();
  }

  public static function store($imgOriginName)
  {
    Images::create([
     'user_id' => auth()->id(),
     'url' => $imgOriginName
   ]);
  }

}
