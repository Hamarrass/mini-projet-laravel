@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{-- {{ __('Dashboard') }} --}}
                   <h1> @lang('messages.welcome')</h1>
                    
                  <h1>  @lang('messages.example_with_value',['name'=>'Sidi Hassane']) </h1>
                  <h1>  {{__('messages.example_with_value',['name'=>'Hassane'])}}     </h1>

                 <p> {{trans_choice('messages.plural',0)}} </p>
                 <p> {{trans_choice('messages.plural',1)}} </p>
                 <p> {{trans_choice('messages.plural',2)}} </p>
                 


                 <h4>{{__('example_with_value', ['name'=>'jamal'])}}</h4>
                 <h4>{{__('welcome')}}</h4>

                 <p> {{trans_choice('plural',0)}} </p>
                 <p> {{trans_choice('plural',1)}} </p>
                 <p> {{trans_choice('plural',2)}} </p>


                    @can('secret.page')
                         <p><a href="/secret">Administration </a></p>
                    @endcan
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
