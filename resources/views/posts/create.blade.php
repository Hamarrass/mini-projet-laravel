@extends('../layout')
@section('content')

    <form   method="POST"  action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
         
        @include('posts.form')
    
        <button class="btn btn-block btn-primary" type="submit">Add Post</button>
    
    </form>

 
    
@endsection