@extends('admin.layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$authors->first())
                <div class="container">
                    <h3 class="text-center">No Authors!</h3>
                </div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->created_at }}</td>
                            <td>{{ $author->updated_at }}</td>
                            <td>{{ $author->role->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.change-role.user', $author) }}"><button class="btn btn-sm btn-success mr-1">Change Role</button></a>
                                    <form action="{{ route('admin.destroy.user', $author) }}" method="post">
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
                    {{ $authors->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

