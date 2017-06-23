@extends('layouts.app')

{{-- @section('img-bg')
    {{asset('img/index-bg.jpg')}}
@endsection

@section('site-title')
    <h1>Everything Tech</h1>
@endsection

@section('sub-heading')
    <span class="subheading">A place where people post opinions or links about current or future tech</span>
@endsection --}}

@section('banner-heading')
    <header class="intro-header" style="background-image: url({{asset('img/index-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class=" col-md-11 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Everything Tech</h1>

                        <hr class="small">

                        <span class="subheading">Where people post opinions about current or future tech</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-md-10 col-md-offset-1">
                <div class="post-panel">
                    <p class="meta">Posted by _ on _ </p>
                    <a href="#">
                        <h2 class="title">Hello</h2>
                        <p class="sub-title">World</p>
                    </a>
                    <hr>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <h1>Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                            <small>Written on {{$post->created_at}} by <span class="username">{{$post->user->username}}</span></small>  
                        </div>
                    </div>                      
                </div>
            @endforeach
            {{ $posts->links() }}
        @else
            <p>No Posts Found</p>
        @endif
    </div>
@endsection