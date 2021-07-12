@extends('admin.layouts.app')

@section('content')
    @forelse($notifications as $notification)
        <div class="alert alert-success" role="alert">
            [{{ $notification->created_at }}] User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just registered.
            <form action="{{ route('admin.notifications.mark', $notification->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-success" data-id="{{ $notification->id }}">
                    Mark as read
                </button>
            </form>
        </div>

        @if($loop->last)
            <form action="{{ route('admin.notifications.mark_all') }}" method="post">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-success" style="margin-left: 1rem" id="mark-all">
                    Mark all as read
                </button>
            </form>
        @endif
    @empty
        There are no new notifications
    @endforelse
@endsection
