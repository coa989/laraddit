@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('create.definition') }}"><button class="btn btn-success">Add New Definition</button></a>
                @foreach($definitions as $definition)
                    <div class="card my-4">
                        <div class="card-header">
                            <a href="{{ route('show.definition', $definition) }}"><h4>{{ $definition->title }}</h4></a>
                            <p>{{ $definition->user->name }} {{ $definition->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="card-body">
                            <p>{{ $definition->body }}</p>
                        </div>
                        <div class="card-footer">
                            <p>
                                <a href="{{ route('show.definition', $definition) }}">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }} points &#183;</a>
                                <a href="">{{ $definition->comments()->count() }} comments</a>
                            </p>
                            <form action="{{ route('like.definition', $definition) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                            </form>
                            <form action="{{ route('dislike.definition', $definition) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                            </form>
                            <p class="mt-4">
                                Tags:
{{--                                @foreach($definition->tags as $tag)--}}
{{--                                    <a href="">{{ $tag->name }}</a>--}}
{{--                                @endforeach--}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--        {{ $posts->links() }}--}}
    </div>
@endsection
