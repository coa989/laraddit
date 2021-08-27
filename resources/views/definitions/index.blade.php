

@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div class="border-end bg-white ml-4 position-fixed" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">Popular</div>
        <div class="list-group list-group-flush">
            @foreach($tags as $tag)
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('tags.definitions', $tag->name) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="container">
        @include ('partials.messages')
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group mb-3">
                            <a href="{{ route('definitions.hot') }}"><button class="btn btn-lg btn-outline-secondary mr-1">Hot</button></a>
                            <a href="{{ route('definitions.index') }}"><button class="btn btn-lg btn-outline-secondary">Fresh</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!$definitions->first())
                    <div class="container">
                        <h3 class="text-center">No definitions!</h3>
                    </div>
                @else
                    @foreach($definitions as $definition)
                        <div class="card my-4">
                            <div class="card-header">
                                <a href="{{ route('definitions.show', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                                <a href="{{ route('users.show', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                                <a>{{ $definition->created_at->diffForHumans() }}</a>
                            </div>
                            <div class="card-body">
                                <p>{{ $definition->body }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group">
                                    <x-like-dislike :model="$definition" likeable-type="App\Models\Definition"/>
                                    <x-info :model="$definition" />
                                </div>
                                <p class="mt-4">
                                    Tags:
                                    @foreach($definition->tags as $tag)
                                        <a href="{{ route('tags.definitions', $tag) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $definitions->links() }}
    </div>
</div>
@endsection
