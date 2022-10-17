<p class="text-muted">
    {{$date}}, by {{$name}}
    {!! isset($name) ? ', by <a href='.route('users.show',['user'=>$userId]) .'>'.$name.'</a>' :null !!}
</p>