

    <div class="card mt-sm-n4">
        <div class="card-body">
            <h4 class="card-title">{{$title}}</h4>
            <p class="text-muted">{{$text}}</p>
        </div>
    
        <ul class="list-group list-group-flush">
            @if(empty(trim($slot)))
                @if($items != "")
                    @foreach($items as $item) 
                    <li class="list-group-item">
                        {{$item}}       
                    </li> 
                @endforeach
             @endif
            @else
              {{$slot }}
            @endif       

            
        </ul>
    </div> 
    
