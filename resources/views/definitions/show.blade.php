@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row">
            <div class="card" style="width: 25rem;">
                <div class="card-header">
                    <a href="{{ route('show.definition', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                    <a href="{{ route('user.profile', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                    <a>{{ $definition->created_at->diffForHumans() }}</a>
                </div>
                <div class="card-body">
                    <p>{{ $definition->body }}</p>
                </div>
                <div class="card-footer">
                    @auth()
                        @if(auth()->user()->role_id === 2)
                            <a href=""><button class="btn btn-primary">Edit</button></a>
                            <form action="{{ route('destroy.definition', $definition) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endauth
                    <p>
                        <a href="{{ route('show.definition', $definition) }}">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }}
                            {{ Str::plural('point', $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count()) }}</a>
                    </p>
                    <div class="btn-group">
                        <form action="{{ route('like.definition', $definition) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                        </form>
                        <form action="{{ route('dislike.definition', $definition) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                        </form>
                    </div>
                    <p class="mt-4">
                        Tags:
                        @foreach($definition->tags as $tag)
                            <a href="{{ route('tag.definition', $tag) }}">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="container">
                <form action="{{ route('comment.definition', $definition) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <p class="mt-2">{{ $definition->comments()->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</p>
                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Write a comment...">{{ old('comment') }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-success mt-2" type="submit">Post</button>
                </form>
                <hr>
                <div class="container">
                    @foreach($definition->comments as $comment)
                        <div class="form-group">
                            <p>
                                <a href="">{{ $comment->user->name }}</a>
                                <a href="">{{ $comment->created_at->diffForHumans() }}</a>
                            </p>
                            <p>{{ $comment->body }}</p>
                            <div class="btn-group">
                                <form action="{{ route('like.definition.comment', $comment) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                </form>
                                <form action="{{ route('dislike.definition.comment', $comment) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                </form>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
