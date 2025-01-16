<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        $comment = $request->input(); 
        if (auth()->id() == null)
        { 
          return redirect('/article?content_link='.$comment['content_link'])
                         ->with('status', 'You can not add a comment. Please sing up first!');
        }

        Comment::create([
          'user_id' => auth()->id(),
          'content_link' => $comment['content_link'],
          'comment' => $comment['comment']
        ]);

        return redirect('/article?content_link='.$comment['content_link']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $request->validate([
        'comment' => 'required|string|max:255'
        ]); 
        
        $comment = $request->input(); 
        if (auth()->id() == null)
        {
          return redirect('/')->with('status', 'You can not add a comment. Please sing up first!');
        }

        Comment::create([
          'user_id' => auth()->id(),
          'content_link' => $comment['content_link'],
          'comment' => $comment['comment']
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
      $request = json_decode($request->input()['data']);

      foreach ($request as $key => $value)
      {
       if (!is_null($value))
       {
         $comment = $comment::where([
           'comment_id' => $key
         ])->update(['comment' => $value]);
       }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
