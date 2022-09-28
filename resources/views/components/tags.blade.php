@foreach ($tags as $tag)    
  <h1><a href="{{route('posts.tag.index',['id'=>$tag->id])}}"> <span style="color:brown">{{$tag->name}}  </span> </a></h1> 
@endforeach