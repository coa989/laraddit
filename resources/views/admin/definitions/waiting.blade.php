@extends('layouts.app')

@section('content')
    <div class="container px-4 py-2" >
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            @dd($posts)
        </div>
    </div>
@endsection
