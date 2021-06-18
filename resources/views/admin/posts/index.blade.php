@extends('layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Author</th>
                        <th scope="col">Image Path</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Approved</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->title }}</th>
                        <th scope="row">{{ $post->slug }}</th>
                        <th scope="row">{{ $post->user->name }}</th>
                        <th scope="row">{{ $post->image_path }}</th>
                        <th scope="row">@foreach($post->tags as $tag) {{ $tag->name }} @endforeach</th>
                        <th scope="row">{{ $post->approved ? 'Yes' : 'No' }}</th>
                        <th scope="row">{{ $post->created_at }}</th>
                        <th scope="row">{{ $post->updated_at }}</th>
                        <th scope="row"><a href="{{ route('show.post', $post) }}"><button class="btn btn-primary">View</button></a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection
