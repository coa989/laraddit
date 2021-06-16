@extends('layouts.app')

@section('content')
    <div class="container px-4 py-2" >
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div>
                    <h1>65</h1>
                    <h5>ALL POSTS</h5>
                    <a href="{{ route('posts') }}" class="btn btn-primary">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>65</h1>
                    <h5>APPROVED POSTS</h5>
                    <a href="{{ route('approved.posts') }}" class="btn btn-success">
                        View
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h1>65</h1>
                    <h5>WAITING APPROVAL</h5>
                    <a href="{{ route('waiting.posts') }}" class="btn btn-secondary">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
