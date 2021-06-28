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
                                        <a href="{{ route('user.profile', $post->user) }}"><b>{{ $post->user->name }}</b></a>
                                        <a class="text-muted time">{{ $post->created_at->diffForHumans() }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-image">
                                <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                                <img src=""><img src="{{ asset($post->image_path) }}" class="image" alt="image post">
                            </div>
                            <div class="post-description">
                                <div class="stats">
                                    <div class="btn-group">
                                        <button class="btn"><i class="fa fa-thumbs-up icon"> {{ $post->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                        <button class="btn"><i class="fa fa-thumbs-down icon"> {{ $post->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                        <button class="btn"><i class="fas fa-comment"></i> {{ $post->comments()->where('approved', true)->count() }} {{ Str::plural('comment', $post->comments()->count()) }}</i></a></button>
                                        <button class="btn">
                                            {{ $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count() }}
                                            {{ Str::plural('point', $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count()) }}
                                        </button>
                                    </div>
                                </div>
                                <p class="mt-2">
                                    Tags:
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('post.tag', $tag) }}">{{ $tag->name }}</a>
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
                                                        <a href="{{ route('user.profile', $comment->user) }}">{{ $comment->user->name }}</a>
                                                    </span>
                                                    <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </span>
                                                </div>
                                                <span>{{ $comment->body }}</span>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn"><i class="fas fa-thumbs-up"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                                <button class="btn"><i class="fas fa-thumbs-down"> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                                @if(!$comment->approved)
                                                    <a href="{{ route('admin.post.comment.approve', $comment) }}"><button class="btn btn-success btn-sm">Approve</button></a>
                                                @endif
                                                <form action="{{ route('admin.post.comment.destroy', $comment) }}" method="post">
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
