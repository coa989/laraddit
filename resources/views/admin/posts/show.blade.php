@extends('admin.layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            @include ('partials.messages')
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <span class="username"><a href="{{ route('admin.users.show', $post->user) }}">{{ $post->user->name }}</a></span>
                        <span class="description">{{ $post->created_at->diffForHumans() }}</span>
                        <h3>{{ $post->title }}</h3>
                    </div>
                </div>
                <div class="box-body" style="display: block;">
                    <img class="img-responsive pad" src="{{ asset($post->medium_image_path) }}" alt="Photo">
                </div>
                <div>
                    <div class="btn-group">
                        <form action="{{ route('post.like', $post) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $post->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                        </form>
                        <form action="{{ route('post.dislike', $post) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $post->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                        </form>
                    </div>
                    <span class="pull-right text-muted">{{ $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count() }}
                        {{ Str::plural('point', $post->likes()->where('is_dislike', 0)->get()->count() - $post->likes()->where('is_dislike', 1)->get()->count()) }}
                    </span>

                    <p class="mt-2">
                        Tags:
                        @foreach($post->tags as $tag)
                            <a href="{{ route('post.tag', $tag) }}">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                    <div class="btn-group">
                        @if(!$post->approved)
                            <a href="{{route('admin.post.approve', $post)}}"><button class="btn btn-success btn-sm">Approve</button></a>
                        @endif
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-3">Delete</button>
                        </form>
                    </div>
                </div>
                <hr>
                <p class="mt-2">{{ $post->comments()->count() }} {{ Str::plural('comment', $post->comments()->count()) }}</p>
                <div class="box-footer box-comments mt-3" style="display: block;">
                    @foreach($post->comments as $comment)
                        <div class="box-comment">
                            <div class="comment-text">
                          <span class="username">
                            <a href="{{ route('user.profile', $comment->user) }}">{{ $comment->user->name }}</a>
                            <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                          </span>
                            </div>
                            <span>{{ $comment->body }}</span>
                        </div>
                        <div class="btn-group">
                            <form action="{{ route('post.like.comment', $comment) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                            </form>
                            <form action="{{ route('post.dislike.comment', $comment) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                            </form>
                            @if(!$comment->approved)
                                <a href="{{ route('admin.post.comment.approve', $comment) }}"><button class="btn btn-success btn-sm">Approve</button></a>
                            @endif
                        </div>
                    @endforeach
                    {{--                <div class="box-footer" style="display: block;">--}}
                    {{--                    <form action="#" method="post">--}}
                    {{--                        <div class="img-push">--}}
                    {{--                            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
                    {{--                </div>--}}
                </div>
            </div>
        </div>
@endsection
