@auth
<h5>Add comment</h5>
<form   method="POST"  action="{{$action}}">
    @csrf
     
<textarea name="content" id="content" class="form-control" ></textarea>
<x-errors my-class="warning"></x-errors>
    <button class="btn btn-block btn-primary" type="submit">Create!</button>

</form>

@else

<a href="" class="btn btn-success btn-sm">Sign In</a> to post a comment

@endauth