@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group mb-3">
                            <a href="{{ route('post.hot') }}"><button class="btn btn-lg btn-outline-secondary mr-1">Hot</button></a>
                            <a href="{{ route('post.index') }}"><button class="btn btn-lg btn-outline-secondary">Fresh</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($definitions as $definition)
            <div class="row d-flex justify-content-center">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-white post">
                                <div class="post-heading">
                                    <div class="pull-left meta">
                                        <div class="title h6">
                                            <a href="{{ route('user.profile', $definition->user) }}"><b>{{ $definition->user->name }}</b></a>
                                            <a class="text-muted time">{{ $definition->created_at->diffForHumans() }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-image">
                                    <h4><a href="{{ route('post.show', $definition) }}">{{ $definition->title }}</a></h4>
                                    <img src=""><img src="{{ asset($definition->medium_image_path) }}" class="image" alt="image post">
                                </div>
                                <div class="post-description">
                                    <div class="stats">
                                        <div class="btn-group">
                                            <form action="{{ route('post.like', $definition) }}" method="post">
                                                @csrf
                                                <button class="btn" type="submit"><i class="fa fa-thumbs-up icon"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                                            </form>
                                            <form action="{{ route('post.dislike', $definition) }}" method="post">
                                                @csrf
                                                <button class="btn" type="submit"><i class="fa fa-thumbs-up icon"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                                            </form>
                                            <button class="btn"><a href="{{ route('post.show', $definition) }}"><i class="fas fa-comment"></i> {{ $definition->comments()->where('approved', true)->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</i></a></button>
                                        </div>
                                    </div>
                                    <p class="mt-2">
                                        Tags:
                                        @foreach($definition->tags as $tag)
                                            <a href="{{ route('post.tag', $tag) }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </p>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $definitions->links() }}
    </div>
@endsection
