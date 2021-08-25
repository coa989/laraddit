@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div class="border-end bg-white ml-4 position-fixed" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">Popular</div>
        <div class="list-group list-group-flush">
            @foreach($tags as $tag)
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('tags.posts', $tag->name) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="container">
        @include ('partials.messages')
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group mb-3">
                            <a href="{{ route('posts.hot') }}"><button class="btn btn-lg btn-outline-secondary mr-1">Hot</button></a>
                            <a href="{{ route('posts.index') }}"><button class="btn btn-lg btn-outline-secondary">Fresh</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($posts as $post)
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
                                    <img src=""><img src="{{ asset($post->medium_image_path) }}" class="image" alt="image post">
                                </div>
                                <div class="post-description">
                                    <div class="stats">
                                        <div class="btn-group">
                                            <form action="{{ route('likes.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="class" value="App\Models\Post">
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ $post->likes_count }}</button>
                                            </form>
                                            <form action="{{ route('dislikes.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="class" value="App\Models\Post">
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ $post->dislikes_count }}</button>
                                            </form>
                                            <button class="btn"><a href="{{ route('posts.show', $post) }}"><i class="fas fa-comment"></i> {{ $post->comments_count }}
                                                    {{ Str::plural('comment', $post->comments_count) }}</i></a></button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>
@endsection
