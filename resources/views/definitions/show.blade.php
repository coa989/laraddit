@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">
                        <a href="{{ route('definition.show', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                        <a href="{{ route('user.profile', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                        <a>{{ $definition->created_at->diffForHumans() }}</a>
                    </div>
                    <div class="card-body">
                        <p>{{ $definition->body }}</p>
                    </div>
                    <div class="card-footer">
                        <p>
                            <a href="">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }} points &#183;</a>
                            <a href="{{ route('definition.show', $definition) }}">
                                <i class="fas fa-comment"> {{ $definition->comments()->where('approved', true)->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</i>
                            </a>
                        </p>
                        <div class="btn-group">
                            <form action="{{ route('definition.like', $definition) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fa fa-thumbs-up icon"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                            </form>
                            <form action="{{ route('definition.dislike', $definition) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fa fa-thumbs-down icon"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                            </form>
                            @can('delete', $definition)
                                <form action="{{ route('definition.destroy', $definition) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                        <p class="mt-4">
                            Tags:
                            @foreach($definition->tags as $tag)
                                <a href="{{ route('definition.tag', $tag) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <form action="{{ route('definition.comment', $definition) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Write a comment...">{{ old('comment') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-success" type="submit">Post</button>
                    </form>
                    <ul class="comments-list">
                        @foreach($definition->comments->where('approved', true) as $comment)
                            <div class="box-footer box-comments mt-3" style="display: block;">
                                <div class="box-comment">
                                    <div class="comment-text">
                                        <span class="username">
                                            <a href="{{ route('user.profile', $comment->user) }}">{{ $comment->user->name }}</a>
                                        </span>
                                        <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span>{{ $comment->body }}</span>
                                </div>
                                <div class="btn-group">

                                    <form action="{{ route('definition.like.comment', $comment) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><i class="fas fa-thumbs-up"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                    </form>
                                    <form action="{{ route('definition.dislike.comment', $comment) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><i class="fas fa-thumbs-down"> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                    </form>
                                </div>
                                <div class="container">
                                    <div class="replybutton btn4 like mb-3">
                                        <button class="btn btn-sm text-muted">Reply</button>
                                    </div>
                                    <div class="col-lg-12 reply" style="display: none">
                                        <form action="{{ route('definition.comment', $definition) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Write a reply...">{{ old('comment') }}</textarea>
                                                @error('body')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-success" type="submit">Reply</button>
                                        </form>
                                    </div>
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
