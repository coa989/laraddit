@extends('admin.layouts.app')

@section('content')
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
{{--                    <div class="ratings ml-2">--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                    </div>--}}
                </div>
                <div class="btn-group">
                    <a href="{{ route('admin.change-role.user', $user) }}"><button class="btn btn-success btn-sm mr-2"> Change Role</button></a>
                    <form action="{{ route('admin.user.destroy', $user) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"> Delete</button>
                    </form>
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
            <a href="{{ route('admin.users.posts', $user) }}"><button class="btn btn-primary"> Posts</button></a>
            <a href="{{ route('admin.users.definitions', $user) }}"> <button class="btn btn-secondary">Definitions</button></a>
            <a href="{{ route('admin.users.comments', $user) }}"><button class="btn btn-dark"> Comments</button></a>
        </div>
    </div>
</div>
</div>
@endsection
