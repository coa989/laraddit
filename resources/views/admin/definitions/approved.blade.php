@extends('layouts.app')

@section('content')
    <div class="container " >
        <div class="row">
            @if(!$definitions->first())
                <div class="container">
                    <h3 class="text-center">No approved definition!</h3>
                </div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Author</th>
                        <th scope="col">Body</th>
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
                            <td>{{ $definition->user->name }}</td>
                            <td>{{ $definition->body }}</td>
                            <td>@foreach($definition->tags as $tag) {{ $tag->name }} @endforeach</td>
                            <td>{{ $definition->created_at }}</td>
                            <td>{{ $definition->updated_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.show.definition', $definition) }}"><button class="btn btn-sm btn-primary mr-1">View</button></a>
                                    <form action="{{ route('admin.destroy.definition', $definition) }}" method="post">
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
                    {{ $definitions->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
