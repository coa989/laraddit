@extends('admin.layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-white post">
                            <div class="post-heading">
                                <div class="pull-left meta">
                                    <div class="title h6">
                                        <a href="{{ route('admin.users.show', $post->user) }}"><b>{{ $post->user->name }}</b></a>
                                        <a class="text-muted time">{{ $post->created_at->diffForHumans() }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-image">
                                <h4>{{ $post->title }}</h4>
                                <img src=""><img src="{{ asset($post->image_path) }}" class="image" alt="image post">
                            </div>
                            <div class="post-description">
                                <div class="stats">
                                    <div class="btn-group">
                                        <button class="btn"><i class="far fa-thumbs-up"></i></i> {{ $post->likes_count }}</button>
                                        <button class="btn"><i class="far fa-thumbs-down"></i> {{ $post->dislikes_count }}</button>
                                        <button class="btn"><i class="fas fa-comment"></i> {{ $post->comments_count }}
                                            {{ Str::plural('comment', $post->comments_count) }}</i></a></button>
                                        <button class="btn">
                                            {{ $post->likes_count - $post->likes_count }}
                                            {{ Str::plural('point', $post->likes_count - $post->dislikes_count) }}
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        @if(!$post->approved)
                                            <a href="{{ route('admin.posts.approve', $post) }}"><button class="btn btn-sm btn-success mr-1">Approve</button></a>
                                        @endif
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mt-2">
                                    Tags:
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('posts.tags', $tag) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </p>
                            </div>
                            <hr>
                            <div class="post-footer">
                                <ul class="comments-list">
                                    @foreach($post->comments as $comment)
                                        <div class="box-footer box-comments mt-3" style="display: block;">
                                            <div class="box-comment">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        <a href="{{ route('admin.users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                                                    </span>
                                                    <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </span>
                                                </div>
                                                <span>{{ $comment->body }}</span>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn"><i class="far fa-thumbs-up"></i> {{ $comment->likes_count }}</button>
                                                <button class="btn"><i class="far fa-thumbs-down"></i> {{ $comment->dislikes_count }}</button>
                                                @if(!$comment->approved)
                                                    <a href="{{ route('admin.comments.approve', $comment) }}"><button class="btn btn-success btn-sm">Approve</button></a>
                                                @endif
                                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
