<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{ 
   public function  __construct () {
        $this->middleware('auth')->only(['create','edit','update','destroy','archive','all']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         

         

         

         return view('posts.index',
          [
              'posts'=>Post::withCount('comments')->with(['user','tags'])->get(),
    
          ]);

    }

    /**
     *0 Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        return  view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        
        $post= $request->except('_token') ;
        $post['slug']   = Str::slug($request->title,'--');
        $post['active'] = true ;
         $post['user_id'] = $request->user()->id  ;
         

         $post = Post::create($post);
         $request->session()->flash('status','bien enregistré');


         return  redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
       $post = Cache::remember('post-show-{$id}',now()->addSeconds(60),function() use($id){
          return  Post::with('comments','tags')->findOrFail($id);
       });

        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize("update",$post);
        
        return view('posts.edit',compact('post'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);

       

        $post->title = $request->title  ; 
        $post->content = $request->content  ;
        $post->save();

        $request->session()->flash('status','the post was updated');

        return redirect()->route('posts.show',['post'=>$id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
         $post= Post::findOrFail($id);
         $this->authorize("delete",$post);
         $post->delete($post);

         $request->session()->flash('status','the post is deleted');

         return redirect()->back() ;

    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $status  = "archive"; 
        $posts = Post::onlyTrashed()->withCount('comments')->get();
         return view('posts.index',['posts'=>$posts,'status'=>$status]);

    }

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $status  = "all"; 
        $posts = Post::withTrashed()->withCount('comments')->get();
         return view('posts.index',['posts'=>$posts,'status'=>$status]);

    }

   
    public function restore($id){
        $post = Post::onlyTrashed()
        ->where('id',$id)->first();

        $this->authorize("restore",$post);
        $post->restore();
        return redirect()->back();
    }

    
  
    public function forceDelete($id){
      
        $post = Post::onlyTrashed()->where('id',$id)->first();
        $this->authorize("forceDelete",$post);
        $post->forceDelete();
        return redirect()->back();
    }
}
