@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
            @if(!$posts->first())
                <div class="container">
                    <h3 class="text-center">No posts!</h3>
                </div>
            @else
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
                                                    <x-like-dislike :model="$post" likeable-type="App\Models\Post"/>
                                                    <button class="btn"><a href="{{ route('posts.show', $post) }}"><i class="fas fa-comment"></i> {{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count ) }}</i></a></button>
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
            @endif
        {{ $posts->links() }}
    </div>
@endsection
