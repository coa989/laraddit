@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group">
            <form action="{{ route('store.post') }}" method="post" class="" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Browse image to upload</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" name="tags">
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>

@endsection
