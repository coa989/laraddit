@extends('admin.layouts.app')

@section('content')

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card mb-2">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h2 v-pre class="card-title mb-0">{{ $user->name }}</h2>--}}
{{--                        <small class="card-subtitle mb-2 text">{{ $user->email }}</small>--}}
{{--                        <small class="card-subtitle mb-2 text-muted">{{ $user->created_at->diffForHumans() }}</small>--}}
{{--                        <p>{{ $definitionPoints + $postPoints }} points</p>--}}
{{--                        @if($user->posts()->get()->count())--}}
{{--                            <p>{{round($postPoints / $user->posts()->get()->count(), 2) }} {{ Str::plural('point', $postPoints / $user->posts()->get()->count()) }} per post</p>--}}
{{--                        @else--}}
{{--                            <p>0 points per post</p>--}}
{{--                        @endif--}}
{{--                        @if($user->definitions()->get()->count())--}}
{{--                            <p>{{ round($definitionPoints / $user->definitions()->get()->count(), 2) }} {{ Str::plural('point', $definitionPoints / $user->definitions()->get()->count()) }} per definition</p>--}}
{{--                        @else--}}
{{--                            <p>0 points per definition</p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="card-footer text-center">--}}
{{--                        <a href="{{ route('user.posts', $user) }}"><button class="btn ">Posts</button></a>--}}
{{--                        <a href="{{ route('user.definitions', $user) }}"><button class="btn ">Definitions</button></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<div class="container mt-3 d-flex justify-content-center">
    <div class="card p-4 mt-3">
        <div class="first">
            <h5 class="heading">{{ $user->name }}</h5>
            <h6 class="heading">{{ $user->email }}</h6>
            <div class="time d-flex flex-row align-items-center justify-content-between mt-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-clock-o clock"></i>
                    <span class="hour ">Member since: {{ $user->created_at->toFormattedDateString() }}</span>
                </div>
            </div>
        </div>
        <div class="second d-flex flex-row mt-2">
{{--            <div class="image mr-3">--}}
{{--                <img src="https://i.imgur.com/0LKZQYM.jpg" class="rounded-circle" width="200" />--}}
{{--            </div>--}}
            <div class="">
                <div class="d-flex flex-row mb-1 font-weight-bold"> <span>Role: {{ $user->role->name }}</span>
                    <div class="ratings ml-2">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="btn-group">
                    @if($user->role_id !== 3)
                        <a href="{{ route('admin.change-role.user', $user) }}"><button class="btn btn-success btn-sm mr-2"><i class="fa fa-clock-o"></i> Change Role</button></a>
                        <form action="{{ route('admin.user.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fa fa-clock-o"></i> Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <hr class="line-color">
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
        <div class="btn-group mt-4">
            <a href="{{ route('user.posts', $user) }}"><button class="btn btn-primary"> Posts</button></a>
            <a href="{{ route('user.definitions', $user) }}"> <button class="btn btn-secondary"><i class="fa fa-clock-o"></i> Definitions</button></a>
            <a href=""><button class="btn btn-dark"><i class="fa fa-clock-o"></i> Comments</button></a>
        </div>
    </div>
</div>
</div>
@endsection
