@extends('layouts.app')

@section('banner-heading')
    <header class="intro-header" style="background-image: url({{asset('img/show-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class=" col-md-11 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Everything Tech</h1>

                        <hr class="small">

                        <span class="subheading">A place where people post opinions or links about current or future tech</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-md-10 col-md-offset-1">
                <div class="post-panel">
                    {{-- <p class="meta">Posted by _ on _ </p>
                    <a href="#">
                        <h2 class="title">Hello</h2>
                        <p class="sub-title">World</p>
                    </a>
                    <hr> --}}
                    <a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    <h1>{{$post->title}}</h1>
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}"> 
                    <br><br>
                    <div>
                        {!!$post->body!!}
                    </div>
                    <hr>
                    <small class="italicize">Written on {{$post->created_at}} by <span class="username">{{$post->user->username}}</span></small>
                    <hr>
                    @if (!Auth::guest())
                        @if (Auth::user()->id == $post->user_id)
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>      
                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'Post', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('DELETE', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection