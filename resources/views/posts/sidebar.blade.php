       
          <x-card  title="Most Post Commented " >
            @foreach($mostComments as $comment) 
                <li class="list-group-item">{{$comment->title}}
                    <span style="background-color: red">{{ $comment->comments_count }} </span>
                </li> 
            @endforeach()
          </x-card>

          <x-card 
            title="Most Users " 
            text="Most Users post written"  
            :items="collect($mostPosts)->pluck('name')">
          </x-card> 
        
          <x-card 
            title="Most User Active" 
            text="Most Users Active in last month"  
            :items="collect($mostUserActiveInlastMonth)->pluck('name')" >
          </x-card>
