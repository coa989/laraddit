@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card" style="width: 25rem;">
                <div class="card-header">
                    <h2 class="text-center">{{ $post->title }}</h2>
                    <img src="{{ asset($post->image_path) }}" alt="" class="card-img"/>
                </div>
                <div class="card-body">
                    <p>
                        <a href="{{ route('user.profile', $post->user) }}">{{ $post->user->name }} &#183;</a>
                        <a>{{ $post->created_at->diffForHumans() }} &#183;</a>
                        <a href="{{ route('show.post', $post) }}">{{ $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count() }} points</a>
                    </p>
                    <div class="card-footer">
                        @auth()
                            @if(auth()->user()->role_id === 2)
                                <a href=""><button class="btn btn-primary">Edit</button></a>
                                <form action="{{ route('destroy.post', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                            <div class="btn-group">
                                <form action="{{ route('like.post', $post) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $post->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                </form>
                                <form action="{{ route('dislike.post', $post) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $post->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                </form>
                            </div>
                            <p class="mt-4">
                                Tags:
                                @foreach($post->tags as $tag)
                                    <a href="">{{ $tag->name }}</a>
                                @endforeach
                            </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="{{ route('comment.post', $post) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <p class="mt-2">{{ $post->comments()->count() }} {{ Str::plural('comment', $post->comments()->count()) }}</p>
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
                    @foreach($post->comments as $comment)
                        <div class="form-group">
                            <p>
                                <a href="">{{ $comment->user->name }}</a>
                                <a href="">{{ $comment->created_at->diffForHumans() }}</a>
                            </p>
                            <p>{{ $comment->body }}</p>
                            <div class="btn-group">
                                <form action="{{ route('like.post.comment', $comment) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                </form>
                                <form action="{{ route('dislike.post.comment', $comment) }}" method="post">
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