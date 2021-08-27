@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">
                        <a href="{{ route('definitions.show', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                        <a href="{{ route('users.show', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                        <a>{{ $definition->created_at->diffForHumans() }}</a>
                    </div>
                    <div class="card-body">
                        <p>{{ $definition->body }}</p>
                    </div>
                    <div class="card-footer">
                        <p>
                            <a href="">{{ $definition->likes_count - $definition->dislikes_count }}
                                {{ Str::plural('point', $definition->likes_count - $definition->dislikes_count) }} &#183;</a>
                            <a href="{{ route('definitions.show', $definition) }}">
                                <i class="fas fa-comment"> {{ $definition->comments_count }}
                                    {{ Str::plural('comment', $definition->comments_count) }}</i>
                            </a>
                        </p>
                        <div class="btn-group">
                            <x-like-dislike :model="$definition" likeable-type="App\Models\Definition"/>
                        @can('delete', $definition)
                                <form action="{{ route('definitions.destroy', $definition) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                        <p class="mt-4">
                            Tags:
                            @foreach($definition->tags as $tag)
                                <a href="{{ route('tags.definitions', $tag) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Write a comment...">{{ old('comment') }}</textarea>
                            <input type="hidden" name="commentable_type" value="App\Models\Definition">
                            <input type="hidden" name="commentable_id" value="{{ $definition->id }}">
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
                        @foreach($comments->where('approved', true) as $comment)
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
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="commentable_type" value="App\Models\Definition">
                                                <input type="hidden" name="commentable_id" value="{{ $definition->id }}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.replybutton').click(function() {
                $(this).next('.reply').toggle();
            });
        });
    </script>
@endsection
