@extends('../layout')

@section('content')

<div class="row">
    <div class="col-8  mt-4">

          <h1>
              <span  style="background-color: brown ; color:aliceblue ;border:10px red solid">{{$posts->count()}}</span>
          </h1>


                  @forelse ($posts as $post)

                    @if($post->created_at->diffInHours() < 1)
                      <x-badge type="green">new</x-badge>
                    @else
                     <x-badge type="red">old</x-badge>
                    @endif

                    {{$post->created_at->diffForHumans()}}

                    @if($post->image)
                     <img class="img-fluid rounded" src="{{ $post->image->url()}}" alt="" srcset="" width="100%" height="">
                    @endif


                    <h2>
                        <a href="{{   route('posts.show',['post'=>$post->id])}}">
                           @if($post->trashed())
                           <dl>
                               <span style="background-color:chartreuse">      {{$post->title}}  </span>
                            </dl>
                             @else
                            {{$post->title}}
                           @endif

                        </a>
                    </h2>



                    <x-tags :tags="$post->tags" > </x-tags>

                       <p>{{$post->content}} </p>
                       <em>{{$post->created_at}} </em>
                       @if($post->comments_count)
                         <div>
                            <x-badge bgColor="red" > {{ $post->comments_count }}</x-badge>
                         </div>
                       @else
                          <div>
                            <x-badge bgColor="red"> no comment yet </x-badge>
                          </div>
                       @endif
                          <div>
                              <x-updated :date="$post->updated_at->diffForHumans()" :name="$post->user->name" :user-id="$post->user->id"></x-updated>
                          </div>

                        @auth

                            @can('update',$post)
                            <a class="btn  btn-sm btn-warning" href="{{route('posts.edit',['post'=>$post->id])}}"  >Edit post </a> </br>
                            @endcan()

                            @cannot('delete', $post)
                                <div >You can't delete this</div>
                            @endcannot

                            @if(!$post->deleted_at)
                                @can('delete',$post)
                                    <form class="form-inline" method="post" action="{{route('posts.destroy',['post'=>$post->id])}}" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"> delete Post </button>
                                    </form>
                                @endcan
                            @else

                                @can('restore',$post)
                                    <form class="form-inline" method="post" action="{{url('/posts/'.$post->id.'/restore')}}" >
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger"> RESTORE Post </button>
                                    </form>
                                @endcan

                                @can('forceDelete',$post)
                                    <form class="form-inline" method="post" action="{{url('/posts/'.$post->id.'/forceDelete')}}" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"> Force delete Post </button>
                                    </form>
                                @endcan
                            @endif
                            @endauth

                        @empty

                                <x-badge> Nothing</x-badge>
                        @endforelse



    </div>

       <div class="col-4">
             @include('posts.sidebar');
       </div>
</div>



@endsection
