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
                        @if($posts->first())
                            <p>{{round($postPoints / $posts->count(), 2) }} {{ Str::plural('point', $postPoints / $posts->count()) }} per post</p>
                        @else
                            <p>0 points per post</p>
                        @endif
                        @if($definitions->first())
                            <p>{{ round($definitionPoints / $definitions->count(), 2) }} {{ Str::plural('point', $definitionPoints / $definitions->count()) }} per definition</p>
                        @else
                            <p>0 points per definition</p>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('users.posts', $user) }}"><button class="btn ">Posts</button></a>
                        <a href="{{ route('users.definitions', $user) }}"><button class="btn ">Definitions</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
