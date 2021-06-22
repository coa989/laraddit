@extends('layouts.app')

@section('content')
    <div class="container " >
        <div class="row ">
            @if(!$users->first())
                <div class="container">
                    <h3 class="text-center">No Users!</h3>
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
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('change-role.user', $user) }}"><button class="btn btn-sm btn-success mr-1">Change Role</button></a>
                                    <form action="{{ route('destroy.user', $user) }}" method="post">
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
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

