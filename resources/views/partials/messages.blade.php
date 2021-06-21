@if (count($messages))
    <div class="row">
        <div class="col-md-12">
            @foreach ($messages as $message)
                <div class="text-center alert alert-{{ $message['level'] }}">{!! $message['message'] !!}</div>
            @endforeach
        </div>
    </div>
@endif
