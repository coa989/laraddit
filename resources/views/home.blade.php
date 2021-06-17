@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card my-5">
                <div class="card-header">
                    <h4>{{ $post->title }}</h4>
                    <p>{{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/'.$post->image_path) }}" alt=""/>
                </div>
                <div class="card-footer">
                    <p>
                        <a href=""> points &#183;</a>
                        <a href=""> comments</a>
                    </p>
                    <a href=""><i class="fas fa-arrow-up mr-4"></i></a>
                    <a href=""><i class="fas fa-arrow-down"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
</div>
@endsection
