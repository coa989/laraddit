@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card" style="width: 25rem;">
            <h2 class="text-center">{{ $post->title }}</h2>
            <img src="{{ asset($post->image_path) }}" alt=""/>
            <div class="card-body">
                <h5>{{ $post->user->name }}</h5>
                <p class="card-text">{{ $post->created_at->diffForHumans() }}</p>
                <div class="card-footer">
                    @if(!$post->approved)
                        <a href="{{ route('admin.approve.post', $post) }}"><button class="btn btn-success">Approve</button></a>
                    @endif
                        <form action="{{ route('admin.destroy.post', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
