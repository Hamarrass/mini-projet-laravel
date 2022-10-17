

@foreach ($comments as $comment)
      <p>{{$comment->content}}</p>
 
      <p>
        <x-updated :date="$comment->updated_at->diffForHumans()" :name="$comment->user->name" :user-id="$comment->user->id"></x-updated>
      </p>
   
@endforeach