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
                                <a href="{{ route('definition.show', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                                <a href="{{ route('user.profile', $definition->user) }}">{{ $definition->user->name }} &#183;</a>
                                <a>{{ $definition->created_at->diffForHumans() }}</a>
                            </div>
                            <div class="card-body">
                                <p>{{ $definition->body }}</p>
                            </div>
                            <div class="card-footer">
                                <p>
                                    <a href="">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }} points &#183;</a>
                                    <a href="{{ route('definition.show', $definition) }}">{{ $definition->comments->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</a>
                                </p>
                                <div class="btn-group">
                                    <form action="{{ route('definition.like', $definition) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                    </form>
                                    <form action="{{ route('definition.dislike', $definition) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                    </form>
                                </div>
                                <p class="mt-4">
                                    Tags:
                                    @foreach($definition->tags as $tag)
                                        <a href="{{ route('definition.tag', $tag) }}">{{ $tag->name }}</a>
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
