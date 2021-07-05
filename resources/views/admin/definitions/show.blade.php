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
                            <a href="">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }} {{ Str::plural('point', $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count()) }}</a>
                        </p>
                        <div class="btn-group">
                            <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</button>
                            <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</button>
                        </div>
                        <div class="btn btn-group-sm">
                            @if(!$definition->approved)
                                <a href="{{ route('admin.definitions.approve', $definition) }}"><button class="btn btn-sm btn-success btn-block">Approve</button></a>
                            @endif
                            <form action="{{ route('admin.definitions.destroy', $definition) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-block" type="submit">Delete</button>
                            </form>
                        </div>
                        <p class="mt-4">
                            Tags:
                            @foreach($definition->tags as $tag)
                                <a href="{{ route('definitions.tags', $tag) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <i class="fas fa-comment">{{ $definition->comments()->where('approved', true)->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</i>
                    <ul class="comments-list">
                        @foreach($definition->comments as $comment)
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
                                <div class="btn-group-sm">
                                    <button class="btn"><i class="far fa-thumbs-up"></i> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</button>
                                    <button class="btn"><i class="far fa-thumbs-down"></i> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</button>
                                </div>
                                <div class="btn-group">
                                    @if(!$comment->approved)
                                        <a href="{{ route('admin.comments.approve', $comment) }}"><button class="btn btn-success btn-sm btn-block">Approve</button></a>
                                    @endif
                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger btn-block">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
