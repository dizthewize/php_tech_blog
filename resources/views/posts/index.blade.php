@extends('layouts.app')

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
    <div class="container">
        <h1>Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="well fade-scroll">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img class="fade-scroll" style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <p class="meta">Posted by <span class="username">{{$post->user->username}}</span> on {{date('M j, Y h:ia', strtotime($post->created_at))}}</p>
                            <h2 class="title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>

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
