@extends('admin.layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            @include ('partials.messages')
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <span class="username"><a href="{{ route('admin.users.show', $definition->user) }}">{{ $definition->user->name }}</a></span>
                        <span class="description">{{ $definition->created_at->diffForHumans() }}</span>
                        <h3>{{ $definition->title }}</h3>
                    </div>
                </div>
                <div class="widget-middle-overflow windget-padding-md clearfix bg-light">
                    <h5 class="mt-lg mb-lg"><span class="fw-semi-bold">{{ $definition->body }}</span></h5>
                    <ul class="tags text-white pull-right">
                    </ul>
                </div>
                <div>
                    <div class="btn-group">
                        <form action="{{ route('definition.like', $definition) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $definition->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                        </form>
                        <form action="{{ route('definition.dislike', $definition) }}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $definition->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                        </form>
                    </div>
                    <span class="pull-right text-muted">{{ $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count() }}
                        {{ Str::plural('point', $definition->likes()->where('is_dislike', 0)->get()->count() - $definition->likes()->where('is_dislike', 1)->get()->count()) }}
                    </span>

                    <p class="mt-2">
                        Tags:
                        @foreach($definition->tags as $tag)
                            <a href="{{ route('definition.tag', $tag) }}">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                    <div class="btn-group">
                        @if(!$definition->approved)
                            <a href="{{route('admin.definition.approve', $definition)}}"><button class="btn btn-success btn-sm">Approve</button></a>
                        @endif
                        <form action="{{ route('admin.definition.destroy', $definition) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-3">Delete</button>
                        </form>
                    </div>
                </div>
                <hr>
                <p class="mt-2">{{ $definition->comments()->count() }} {{ Str::plural('comment', $definition->comments()->count()) }}</p>
                <div class="box-footer box-comments mt-3" style="display: block;">
                    @foreach($definition->comments as $comment)
                        <div class="box-comment">
                            <div class="comment-text">
                          <span class="username">
                            <a href="{{ route('admin.users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                            <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                          </span>
                            </div>
                            <span>{{ $comment->body }}</span>

                        </div>
                        <div class="btn-group">
                            <form action="{{ route('definition.like.comment', $comment) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-up mr-4"> {{ $comment->likes()->where('is_dislike', 0)->get()->count() }}</i></button>
                            </form>
                            <form action="{{ route('definition.dislike.comment', $comment) }}" method="post">
                                @csrf
                                <button class="btn" type="submit"><i class="fas fa-arrow-down mr-4"> {{ $comment->likes()->where('is_dislike', 1)->get()->count() }}</i></button>
                            </form>
                            @if(!$comment->approved)
                                <a href="{{ route('admin.definition.comment.approve', $comment) }}"><button class="btn btn-success btn-sm">Approve</button></a>
                            @endif
                            <form action="{{ route('admin.post.comment.destroy', $comment) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
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
