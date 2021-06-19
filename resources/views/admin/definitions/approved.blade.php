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
                        <th scope="row">{{ $definition->title }}</th>
                        <th scope="row">{{ $definition->slug }}</th>
                        <th scope="row">{{ $definition->user->name }}</th>
                        <th scope="row">{{ $definition->body }}</th>
                        <th scope="row">@foreach($definition->tags as $tag) {{ $tag->name }} @endforeach</th>
                        <th scope="row">{{ $definition->created_at }}</th>
                        <th scope="row">{{ $definition->updated_at }}</th>
                        <th scope="row"><a href="{{ route('admin.show.definition', $definition) }}"><button class="btn btn-primary">View</button></a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $definitions->links() }}
            </div>
        </div>
    </div>

@endsection
