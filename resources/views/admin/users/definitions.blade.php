@extends('admin.layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$definitions->first())
                <div class="container">
                    <h3 class="text-center">No definition!</h3>
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
                    @foreach($definitions as $definition)
                        <tr>
                            <td>{{ $definition->title }}</td>
                            <td>{{ $definition->slug }}</td>
                            <td><a href="{{ route('admin.users.show', $definition->user) }}">{{ $definition->user->name }}</a></td>
                            <td><img src="{{ asset($definition->thumbnail) }}" alt=""></td>
                            <td>@foreach($definition->tags as $tag) {{ $tag->name }} @endforeach</td>
                            <td>{{ $definition->created_at->diffForHumans() }}</td>
                            <td>{{ $definition->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group">
                                    @if(!$definition->approved)
                                        <a href="{{ route('admin.definitions.approve', $definition) }}"><button class="btn btn-sm btn-success mr-1">Approve</button></a>
                                    @endif
                                    @if(!$definition->rejected)
                                        <a href="{{ route('admin.definitions.reject', $definition) }}"><button class="btn btn-sm btn-warning mr-1">Reject</button></a>
                                    @endif
                                    <a href="{{ route('admin.definitions.show', $definition) }}"><button class="btn btn-sm btn-primary mr-1">View</button></a>
                                    <form action="{{ route('admin.definitions.destroy', $definition) }}" method="post">
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
                    @if($definitions->first())
                        {{ $definitions->links() }}
                    @endif
                </div>
            @endif
        </div>
    </div>

@endsection
