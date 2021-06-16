@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group">
            <form action="{{ route('store.post') }}" method="post" class="">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="image">Browse image to upload</label>
                    <input type="file" class="form-control-file" name="image">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>

@endsection
