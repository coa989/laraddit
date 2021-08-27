<button class="btn">
    <a href="{{ route('posts.show', $model) }}"><i class="fas fa-comment"></i>
        {{ $model->comments_count }}
        {{ Str::plural('comment', $model->comments_count) }}</i>
    </a>
</button>
<button class="btn">
    {{ $model->likes_count - $model->dislikes_count }}
    {{ Str::plural('point', $model->likes_count - $model->dislikes_count) }}
</button>
