<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostTagController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
         $tag = Tag::find($id);
     
         return view('posts.index',[
             'posts'=>$tag->posts()->postWithUserCommentsTags->get(),
             'mostComments'=> [] ,
             'mostPosts' => [] ,
             'mostUserActiveInlastMonth' =>[]
            ]);

    }
}
