@extends('layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$guests->first())
                <div class="container">
                    <h3 class="text-center">No Guests!</h3>
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
                    @foreach($guests as $guest)
                        <tr>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->created_at }}</td>
                            <td>{{ $guest->updated_at }}</td>
                            <td>{{ $guest->role->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.change-role.user', $guest) }}"><button class="btn btn-sm btn-success mr-1">Change Role</button></a>
                                    <form action="{{ route('admin.destroy.user', $guest) }}" method="post">
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
                    {{ $guests->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

