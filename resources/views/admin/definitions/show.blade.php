@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card" style="width: 25rem;">
                <h2 class="text-center">{{ $definition->title }}</h2>
                <img src="{{ asset($definition->image_path) }}" alt=""/>
                <div class="card-body">
                    <h5> {{ $definition->user->name }}</h5>
                    <p class="card-text">{{ $definition->created_at->diffForHumans() }}</p>
                    <div class="card-footer">
                        @if(!$definition->approved)
                            <a href="{{ route('approve.definition', $definition) }}"><button class="btn btn-success">Approve</button></a>
                        @endif
                        <a href=""><button class="btn btn-primary">Edit</button></a>
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
