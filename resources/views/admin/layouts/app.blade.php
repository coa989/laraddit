<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
    <!-- Perfect Scrollbar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.1/css/perfect-scrollbar.min.css" integrity="sha512-ygIxOy3hmN2fzGeNqys7ymuBgwSCet0LVfqQbWY10AszPMn2rB9JY0eoG0m1pySicu+nvORrBmhHVSt7+GI9VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Zagrc Admin</title>
</head>
<body class="c-app">
@include('admin.partials.sidebar')

<div class="c-wrapper c-fixed-components">
@include('admin.partials.navbar')
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- Perfect Scrollbar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.1/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Popper.js first, then CoreUI JS -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
</body>
</html>
{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <!-- Bootstrap tags input -->--}}

{{--    <script src="{{asset('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>--}}
{{--    <!-- Type aheaed -->--}}
{{--    <script src="{{ asset('/js/typeahead/dist/typeahead.bundle.min.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('/js/typeahead/dist/bloodhound.min.js') }}" type="text/javascript"></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div id="app">--}}
{{--    @include('admin.layouts.navbar')--}}

{{--    <main class="py-4">--}}

{{--        @yield('content')--}}
{{--    </main>--}}

{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
