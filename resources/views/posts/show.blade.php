@extends('layouts.app')
@section('content')

<div class="row">
   <div class="col-8">
      <h2>{{$post->title}} </h2>
      @if($post->image)
                    <img class="img-fluid rounded" src="{{ $post->image->url()}}" alt="" srcset="">
                    @endif
      <p>{{$post->content}} </p>
      <x-tags :tags="$post->tags" > </x-tags>
      <em>{{$post->created_at->diffForHumans()}} </em>

      <span>{{$post->active}}</span>

      <x-comment-form :action="route('posts.comments.store',['post'=>$post->id])"></x-comment-form>
      <hr>
      <x-comment-list  :comments="$post->comments" ></x-comment-list>
   </div>

   <div class="col-4">
      @include('posts.sidebar');
   </div>
</div>


        
@endsection