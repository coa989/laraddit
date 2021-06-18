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
                    <h5>by: {{ $post->user->name }}</h5>
                    <p class="card-text">{{ $post->created_at->diffForHumans() }}</p>
                    <div class="card-footer">
                        @if(auth()->user()->role_id === 2)
                            <a href=""><button class="btn btn-primary">Edit</button></a>
                            <form action="{{ route('destroy.post', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        @endif
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
            </div>
        </div>
    </div>
@endsection
