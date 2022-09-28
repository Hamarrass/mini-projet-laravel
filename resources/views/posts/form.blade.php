<div class="form-group">
    <label for="title">Your Title</label>
    <input class="form-control" name="title" for="title" id="title" type="text" value="{{old('title',$post->title ?? '')}}">
</div>
<div class="from-group">
    <label for="content">content</label>
    <input class="form-control" name="content"   for="content" id="content" type="text" value="{{old('content',$post->content ?? '')}}">
</div>

<x-errors my-class="warning"></x-errors>  