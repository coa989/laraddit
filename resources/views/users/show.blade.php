@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body text-center">
                        <h2 v-pre class="card-title mb-0">{{ $user->name }}</h2>
                        <small class="card-subtitle mb-2 text">{{ $user->email }}</small>
                        <small class="card-subtitle mb-2 text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        <p>{{ $definitionPoints + $postPoints }} points</p>
                        @if($user->posts()->get()->count())
                            <p>{{round($postPoints / $user->posts()->get()->count(), 2) }} {{ Str::plural('point', $postPoints / $user->posts()->get()->count()) }} per post</p>
                        @else
                            <p>0 points per post</p>
                        @endif
                        @if($user->definitions()->get()->count())
                            <p>{{ round($definitionPoints / $user->definitions()->get()->count(), 2) }} {{ Str::plural('point', $definitionPoints / $user->definitions()->get()->count()) }} per definition</p>
                        @else
                            <p>0 points per definition</p>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('user.posts', $user) }}"><button class="btn ">Posts</button></a>
                        <a href="{{ route('user.definitions', $user) }}"><button class="btn ">Definitions</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
