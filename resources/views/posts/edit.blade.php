@extends('../layout')
@section('content')
  <h1>Edit post </h1>
    <form   method="POST"  action="{{route('posts.update',['post'=>$post->id])}}">
        @csrf
        @method('put')
     
         @include('posts.form')

        <button class="btn btn-block btn-warning " type="submit">Update Post</button>
    </form>


    
@endsection