@extends('admin.layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">
                        <a href="{{ route('admin.definitions.show', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                        <a href="{{ route('admin.users.show', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                        <a>{{ $definition->created_at->diffForHumans() }}</a>
                    </div>
                    <div class="card-body">
                        <p>{{ $definition->body }}</p>
                    </div>
                    <div class="card-footer">
                        <p>
                            <a href="">{{ $definition->likes_count - $definition->dislikes_count }}
                                {{ Str::plural('point', $definition->likes_count - $definition->dislikes_count) }}</a>
                        </p>
                        <div class="btn-group">
                            <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ $definition->likes_count }}</button>
                            <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ $definition->dislikes_count }}</button>
                            @if(!$definition->approved)
                                <a href="{{ route('admin.definitions.approve', $definition) }}"><button class="btn btn-sm btn-success btn-block">Approve</button></a>
                            @endif
                            @if(!$definition->rejected)
                                <a href="{{ route('admin.definitions.reject', $definition) }}"><button class="btn btn-sm btn-warning mr-1">Reject</button></a>
                            @endif
                            <form action="{{ route('admin.definitions.destroy', $definition) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-block" type="submit">Delete</button>
                            </form>
                        </div>
                        <div class="btn btn-group-sm">

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
                    <i class="fas fa-comment"></i> {{ $definition->comments_count }}
                    {{ Str::plural('comment', $definition->comments_count) }}
                    <ul class="comments-list">
                        @foreach($comments->where('parent_id', null) as $comment)
                            <div class="box-footer box-comments mt-3" style="display: block;">
                                <div class="box-comment">
                                    <div class="comment-text">
                                        <span class="username">
                                            <a href="{{ route('admin.users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                                        </span>
                                        <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span>{{ $comment->body }}</span>
                                </div>
                                <div class="btn-group">
                                    <button class="btn"><i class="far fa-thumbs-up"></i> {{ $comment->likes_count }}</button>
                                    <button class="btn"><i class="far fa-thumbs-down"></i> {{ $comment->dislikes_count }}</button>
                                    @if(!$comment->approved)
                                        <a href="{{ route('admin.comments.approve', $comment) }}"><button class="btn btn-success btn-sm btn-block">Approve</button></a>
                                    @endif
                                    @if(!$comment->rejected)
                                        <a href="{{ route('admin.comments.reject', $comment) }}"><button class="btn btn-warning btn-sm btn-block">Reject</button></a>
                                    @endif
                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger btn-block">Delete</button>
                                    </form>
                                </div>
                                <div class="container">
                                    @if($comment->replies->first())
                                        @foreach($comment->replies as $reply)
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
                                                <button class="btn"><i class="far fa-thumbs-up"></i> {{ $reply->likes_count }}</button>
                                                <button class="btn"><i class="far fa-thumbs-down"></i> {{ $reply->dislikes_count }}</button>
                                                @if(!$reply->approved)
                                                    <a href="{{ route('admin.comments.approve', $reply) }}"><button class="btn btn-success btn-sm btn-block">Approve</button></a>
                                                @endif
                                                @if(!$reply->rejected)
                                                    <a href="{{ route('admin.comments.reject', $reply) }}"><button class="btn btn-warning btn-sm btn-block">Reject</button></a>
                                                @endif
                                                <form action="{{ route('admin.comments.destroy', $reply) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
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
@endsection
