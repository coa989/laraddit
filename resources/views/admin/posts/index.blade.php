@extends('admin.layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$posts->first())
                <div class="container">
                    <h3 class="text-center">No post!</h3>
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
                            <td><a href="{{ route('admin.users.show', $post->user) }}">{{ $post->user->name }}</a></td>
                            <td><img src="{{ asset($post->thumbnail) }}" alt=""></td>
                            <td>@foreach($post->tags as $tag) {{ $tag->name }} @endforeach</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group">
                                    @if(!$post->approved)
                                        <a href="{{ route('admin.posts.approve', $post) }}"><button class="btn btn-sm btn-success mr-1">Approve</button></a>
                                    @endif
                                    <a href="{{ route('admin.posts.show', $post) }}"><button class="btn btn-sm btn-primary mr-1">View</button></a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
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
