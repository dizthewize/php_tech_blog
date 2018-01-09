@extends('layouts.app')

@section('banner-heading')
    <div id="show-post">
        <header class="intro-header" style="background-image: url({{asset('img/show-bg.jpg')}})">
            <div class="container">
                <div class="row">
                    <div class=" col-md-11 col-md-offset-1">
                        <div class="site-heading">
                            <h1 class="title">{{$post->title}}</h1>

                            <hr class="small">
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-md-10 col-md-offset-1">
                <div class="post-panel">
                    <a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    <h1 class="title">{{$post->title}}</h1>
                    <img style="width:100%" src="{{$post->cover_image}}">
                    <br><br>
                    <div>
                        {!!$post->body!!}
                    </div>
                    <hr>
                    <small class="italicize">Written on {{ date('M j, Y h:ia', strtotime($post->created_at))}} by <span class="username">{{$post->user->username}}</span></small>
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
        <div class="container">
            @if (!Auth::guest())
                @if (Auth::user())
                    <div class="row">
                        <div id="comment-form" class="col-md-8 col-md-offset-2">
                            <h3>Add Comment</h3><br/>
                            {!! Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {{Form::label('comment', 'Comment:')}}
                                {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Comment Text'])}}
                            </div>
                            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div id="comment-section" class="col-md-8 col-md-offset-2">
                    <h3>Comments</h3><br/>
                    @if(count($comments) > 0)
                        @foreach($comments as $comment)
                        <h4 class="username"><strong>{{$comment->username}}</strong></h4>
                        <p class="comment">{{$comment->comment}}</p>
                        <small class="comment-created-at">Added on {{date('M j, Y h:ia', strtotime($comment->created_at))}}</small>
                        <hr/>
                        @endforeach
                    @else
                        <p>No Comments Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
