<form action="{{ route('likes.store') }}" method="post">
    @csrf
    <input type="hidden" name="likeable_type" value="{{ $likeableType }}">
    <input type="hidden" name="likeable_id" value="{{ $model->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ $model->likes_count }}</button>
</form>
<form action="{{ route('dislikes.store') }}" method="post">
    @csrf
    <input type="hidden" name="likeable_type" value="{{ $likeableType }}">
    <input type="hidden" name="likeable_id" value="{{ $model->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ $model->dislikes_count }}</button>
</form>

