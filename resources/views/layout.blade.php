<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{mix('css/theme.css')}}"> --}}
    <title>Document</title>
</head>
<body>
    @if(session()->has('status'))
      <h1 style="color: green">{{session()->get('status')}}</h1>
    @endif

    <nav class="navbar navbar-expand navbar-dark bg-success">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{route('home')}}">{{__('Home')}}          </a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('about')}}">{{__('Contact')}}      </a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}">{{__('Posts')}}  </a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('posts.create')}}">{{__('Add')}}   </a></li>
        </ul>
    </nav>
    <div class="container">
       @yield('content')
    </div>

     <script src="{{mix('/js/app.js')}}"></script>
</body>
</html>
