@extends('../layout')
@section('content')

<div class="row">
   <div class="col-8">
      <h2>{{$post->title}} </h2>
      <p>{{$post->content}} </p>
      <x-tags :tags="$post->tags" > </x-tags>
      <em>{{$post->created_at->diffForHumans()}} </em>
   
   
      <span>{{$post->active}}</span>

      @include('comments.form',['id'=>$post->id])
      <hr>
   
      @foreach ($post->comments as $comment)
             <p>{{$comment->content}}</p>
        
             <p>
               <x-updated :date="$comment->updated_at->diffForHumans()" :name="$comment->user->name"></x-updated>
             </p>
          
      @endforeach
      
   </div>

   <div class="col-4">
      @include('posts.sidebar');
   </div>
</div>


        
@endsection