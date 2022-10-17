<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Mail\CommentedPostMarkdown;
use Illuminate\Support\Facades\Mail;


class PostCommentController extends Controller
{
    
   public function __construct()
   {
       $this->middleware('auth')->only(['store']);
   }

 public function store(StoreComment $request ,Post $post){
 
   $comment = $post->comments()->create([
       'content' => $request->content,
       'user_id' => $request->user()->id
    ]);


    // Mail::to($post->user->email)->send(new CommentPosted($comment));
    Mail::to($post->user->email)->send(new CommentedPostMarkdown($comment));
      
    return redirect()->back();
 }

}
 