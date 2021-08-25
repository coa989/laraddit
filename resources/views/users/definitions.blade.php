

@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
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
                                <p>
                                    <a href="">{{ $definition->likes_count - $definition->dislikes_count }} points &#183;</a>
                                    <a href="{{ route('definitions.show', $definition) }}">
                                        <i class="fas fa-comment"></i> {{ $definition->comments_count }} {{ Str::plural('comment', $definition->comments_count) }}</i>
                                    </a>
                                </p>
                                <div class="btn-group">
                                    <form action="{{ route('likes.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="class" value="App\Models\Definition">
                                        <input type="hidden" name="id" value="{{ $definition->id }}">
                                        <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ $definition->likes_count }}</button>
                                    </form>
                                    <form action="{{ route('dislikes.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="class" value="App\Models\Definition">
                                        <input type="hidden" name="id" value="{{ $definition->id }}">
                                        <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ $definition->dislikes_count }}</button>
                                    </form>
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
@endsection
