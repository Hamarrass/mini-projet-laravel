@extends('layouts.app')
@section('content')

@php
 $language = $language ?? "";    
@endphp
    <form action="{{route('users.update',['user'=>$user->id])}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-4">
                <h5>select a diffrence Avatare</h5>
                <img src="{{$user->image ? $user->image->url() : "" }}" alt="" class="img-thumbnail">
                <input type="file" name="avatar" id="avatar" class="form-control-file">
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="language"></label>
                    <select name="locale" id="language" class="form-control">
                        @foreach(App\Models\User::LOCALES as $locale =>$label)
                         <option @if($user->locale==$locale) selected  @endif value="{{old('local',$locale?? '')}}">{{$label}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-warning btn-block">Update</button>
            </div>
        </div>
    </form>
@endsection 