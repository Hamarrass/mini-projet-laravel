<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Models\Post;
use App\Mail\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{
    
   public function __construct()
   {
       $this->middleware('auth')->only(['store']);
   }


  public function show(Post $post){
    return   CommentResource::collection($post->comments()->with('user')->get());
  }

 public function store(StoreComment $request ,Post $post){
 
   $comment = $post->comments()->create([
       'content' => $request->content,
       'user_id' => $request->user()->id
    ]);

    event(new  EventsCommentPosted($comment));

    // Mail::to($post->user->email)->send(new CommentPosted($comment));
    // Mail::to($post->useq r->email)->send(new CommentedPostMarkdown($comment));
  
    // $when = now()->addMinute(1); 
    // Mail::to($post->user->email)->later($when,new CommentedPostMarkdown($comment));
      
    return redirect()->back();
 }

}
 