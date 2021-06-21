@extends('layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$posts->first())
                <div class="container">
                    <h3 class="text-center">No post waiting approval!</h3>
                </div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Author</th>
                        <th scope="col">Image</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td><img src="{{ asset($post->small_image_path) }}"></td>
                            <td>@foreach($post->tags as $tag) {{ $tag->name }} @endforeach</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>
                                <div class="btn-group">
                                    @if(!$post->approved)
                                        <a href="{{ route('approve.post', $post) }}"><button class="btn btn-sm btn-success mr-1">Approve</button></a>
                                    @endif
                                    <a href="{{ route('admin.show.post', $post) }}"><button class="btn btn-sm btn-primary mr-1">View</button></a>
                                    <a href="{{ route('admin.show.post', $post) }}"><button class="btn btn-sm btn-secondary mr-1">Edit</button></a>
                                    <form action="{{ route('admin.destroy.post', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
