@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card" style="width: 25rem;">
                <h2 class="text-center">{{ $definition->title }}</h2>
                <p class="text-center font-weight-bold">{{ $definition->body }}</p>
                <div class="card-body">
                    <h5> {{ $definition->user->name }}</h5>
                    <p class="card-text">{{ $definition->created_at->diffForHumans() }}</p>
                    <div class="card-footer">
                        @if(!$definition->approved)
                            <a href="{{ route('approve.definition', $definition) }}"><button class="btn btn-success">Approve</button></a>
                        @endif
                        <form action="{{ route('admin.destroy.definition', $definition) }}" method="post">
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
