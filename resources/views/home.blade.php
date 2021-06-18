@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('create.post') }}"><button class="btn btn-success">Add New Post</button></a>
        @foreach($posts as $post)
            <div class="card my-4">
                <div class="card-header">
                    <a href="{{ route('show.post', $post) }}"><h4>{{ $post->title }}</h4></a>
                    <p>{{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="card-body">
                    <img src="{{ asset($post->image_path) }}" alt=""/>
                </div>
                <div class="card-footer">
                    <p>
                        <a href=""> points &#183;</a>
                        <a href=""> comments</a>
                    </p>
                    <form action="{{ route('like.post', $post) }}" method="post">
                        @csrf
                        <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $post->likes()->count() }}</i></button>
                    </form>
                    <form action="" method="post">
                        @csrf
                        <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"></i></button>
                    </form>
                        <p class="mt-4">
                            Tags:
                            @foreach($post->tags as $tag)
                                <a href="">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
</div>
@endsection
