@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('create.post') }}"><button class="btn btn-success">Add New Post</button></a>
        @foreach($posts as $post)
            <div class="card my-4">
                <div class="card-header">
                    <h4>{{ $post->title }}</h4>
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

                    <a href=""><i class="fas fa-arrow-up mr-4"></i></a>
                    <a href=""><i class="fas fa-arrow-down"></i></a>
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
