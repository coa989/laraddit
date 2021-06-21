@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!$posts->first())
                    <div class="container">
                        <h3 class="text-center">No definitions!</h3>
                    </div>
                @else
                    @foreach($posts as $post)
                        <div class="card my-4">
                            <div class="card-header">
                                <a href="{{ route('show.post', $post) }}"><h4>{{ $post->title }}</h4></a>
                                <a href="{{ route('user.profile', $post->user) }}">{{ $post->user->name }} &#183;</a>
                                <a>{{ $post->created_at->diffForHumans() }}</a>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset($post->image_path) }}" alt=""/>
                            </div>
                            <div class="card-footer">
                                <p>
                                    <a href="{{ route('show.post', $post) }}">{{ $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count() }} points &#183;</a>
                                    <a href="{{ route('show.post', $post) }}">{{ $post->comments()->count() }} {{ Str::plural('comment', $post->comments()->count()) }}</a>
                                </p>
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
                                        <a href="{{ route('tag.post', $post) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $posts->links() }}
    </div>
@endsection
