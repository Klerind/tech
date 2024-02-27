<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\ContentController;

class PostController extends Controller
{
     public function create(Request $request)
     {
         $inputs = $request->input();
         ContentController::create($request);

         return redirect('/profile');
      }

      public function edit(Request $request)
      {
        $requests = $request->input();
        $contents_id = explode(",", $requests['contents_id']);
        //dd(array_values($contents_id));

        $post_contents = [];

        foreach ($contents_id as $content_id)
        {
         $post_contents[] = ContentController::getContentsForSingelItem($content_id);
        }
        //dd($post_contents);
        return view('pages/post', [
          'post_contents' => $post_contents
        ]);
      }

      public function delete(Request $request)
      {
        $requests = $request->input();
        $contents_id = explode(",", $requests['contents_id']);
        //dd($contents_id);
        foreach ($contents_id as $content_id)
        {
           ContentController::delete($content_id);
        }

        return redirect('/profile');
      //  return view('pages/post', ['post' => Post::find($id)]);
      }

      public function getSinglePost($id)
      {
        return view('pages/post', ['post' => Post::find($id)]);
      }

}
