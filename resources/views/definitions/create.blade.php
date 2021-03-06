@extends('layouts.app')

@section('content')
    <div class="container">
        @include ('partials.messages')
        <div class="form-group">
            <form action="{{ route('definitions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control @error('title') is-invalid @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tag_list">Tags:</label>
                    <select id="tag_list" name="tag_list[]" class="form-control" multiple></select>
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/tag.js') }}"></script>
@endsection
