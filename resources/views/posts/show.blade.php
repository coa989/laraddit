@extends('layouts.app')

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
                                        <a href="{{ route('users.show', $post->user) }}"><b>{{ $post->user->name }}</b></a>
                                        <a class="text-muted time">{{ $post->created_at->diffForHumans() }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-image">
                                <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                                <img src=""><img src="{{ asset($post->image_path) }}" class="image" alt="image post">
                            </div>
                            <div class="post-description">
                                <div class="stats">
                                    <div class="btn-group">
                                        <x-like-dislike :model="$post" likeable-type="App\Models\Post"/>
                                        <button class="btn"><a href="{{ route('posts.show', $post) }}"><i class="fas fa-comment"></i> {{ $post->comments_count }}
                                                {{ Str::plural('comment', $post->comments_count) }}</i></a></button>
                                        <button class="btn">{{ $post->likes_count - $post->dislikes_count }}
                                            {{ Str::plural('point', $post->likes_count - $post->dislikes_count) }}
                                        </button>
                                        @can('delete-post', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-1">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <p class="mt-2">
                                    Tags:
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('tags.posts', $tag) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </p>
                            </div>
                            <hr>
                            <div class="post-footer">
                                <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Write a comment...">{{ old('comment') }}</textarea>
                                        <input type="hidden" name="commentable_type" value="App\Models\Post">
                                        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        @error('body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success" type="submit">Post</button>
                                </form>
                                <ul class="comments-list">
                                    @foreach($comments->where('approved', true)->where('parent_id', null) as $comment)
                                        <div class="box-footer box-comments mt-3" style="display: block;">
                                            <div class="box-comment">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                                                    </span>
                                                    <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <span>{{ $comment->body }}</span>
                                            </div>
                                            <div class="btn-group">
                                                <x-like-dislike :model="$comment" likeable-type="App\Models\Comment"/>
                                            </div>
                                            <div class="container">
                                                <div class="replybutton btn4 like mb-3">
                                                    <button class="btn btn-sm text-muted">Reply</button>
                                                </div>
                                                <div class="col-lg-12 reply" style="display: none">
                                                    <form action="{{ route('replies.store') }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{ $comment->id }}" name="parent_id">
                                                            <input type="hidden" name="commentable_type" value="App\Models\Post">
                                                            <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                            <textarea name="body" class="form-control @error('replyBody') is-invalid @enderror" placeholder="Write a reply...">{{ old('comment') }}</textarea>
                                                            @error('replyBody')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <button class="btn btn-success" type="submit">Reply</button>
                                                    </form>
                                                </div>
                                                @if($comment->replies->first())
                                                    @foreach($comment->replies as $reply)
                                                        @if($reply->approved)
                                                            <div class="box-footer box-comments mt-3" style="display: block;">
                                                                <div class="box-comment">
                                                                    <div class="comment-text">
                                                                        <span class="username">
                                                                            <a href="{{ route('users.show', $reply->user) }}">{{ $reply->user->name }}</a>
                                                                        </span>
                                                                        <span class="text-muted pull-right">{{ $reply->created_at->diffForHumans() }}</span>
                                                                    </div>
                                                                    <span>{{ $reply->body }}</span>
                                                                </div>
                                                                <div class="btn-group">
                                                                    <x-like-dislike :model="$reply" likeable-type="App\Models\Comment"/>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.replybutton').click(function() {
                $(this).next('.reply').toggle();
            });
        });
    </script>
@endsection
