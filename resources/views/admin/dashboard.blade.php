@extends('admin.layouts.app')

@section('content')
    <div class="container px-4 py-2" >
        @include('partials.messages')
        <h2 class="font-weight-bold">POSTS</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-4">
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Post::all()) }}</h1>
                    <h5>ALL POSTS</h5>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Post::where('approved', true)->get()) }}</h1>
                    <h5>APPROVED POSTS</h5>
                    <a href="{{ route('admin.posts.approved') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Post::where('approved', false)->where('rejected', false)->get()) }}</h1>
                    <h5>PENDING POSTS</h5>
                    <a href="{{ route('admin.posts.pending') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Post::where('rejected', true)->get()) }}</h1>
                    <h5>REJECTED POSTS</h5>
                    <a href="{{ route('admin.posts.rejected') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 py-2" >
        <h2 class="font-weight-bold">DEFINITIONS</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-4">
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Definition::all()) }}</h1>
                    <h5>ALL DEFINITIONS</h5>
                    <a href="{{ route('admin.definitions.index') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Definition::where('approved', true)->get()) }}</h1>
                    <h5>APPROVED DEFINITIONS</h5>
                    <a href="{{ route('admin.definitions.approved') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Definition::where('approved', false)->where('rejected', false)->get()) }}</h1>
                    <h5>PENDING DEFINITIONS</h5>
                    <a href="{{ route('admin.definitions.pending') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Definition::where('rejected', true)->get()) }}</h1>
                    <h5>REJECTED DEFINITIONS</h5>
                    <a href="{{ route('admin.definitions.rejected') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 py-2" >
        <h2 class="font-weight-bold">COMMENTS</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-4">
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Comment::all()) }}</h1>
                    <h5>ALL COMMENTS</h5>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Comment::where('approved', true)->get()) }}</h1>
                    <h5>APPROVED COMMENTS</h5>
                    <a href="{{ route('admin.comments.approved') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Comment::where('approved', false)->where('rejected', false)->get()) }}</h1>
                    <h5>PENDING COMMENTS</h5>
                    <a href="{{ route('admin.comments.pending') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\Comment::where('rejected', true)->get()) }}</h1>
                    <h5>REJECTED COMMENTS</h5>
                    <a href="{{ route('admin.comments.rejected') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 py-2" >
        <h2 class="font-weight-bold">USERS</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\User::all()) }}</h1>
                    <h5>ALL USERS</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\User::where('role_id', 2)->get()) }}</h1>
                    <h5>AUTHORS</h5>
                    <a href="{{ route('admin.users.authors') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>{{ count(\App\Models\User::where('role_id', 1)->get()) }}</h1>
                    <h5>GUESTS</h5>
                    <a href="{{ route('admin.users.guests') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
