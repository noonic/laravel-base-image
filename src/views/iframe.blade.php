<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Noonic Laravel Base - Image</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/jumbotron-narrow.css') }}" />
    <style type="text/css">
        html, body { margin: 0px; padding: 0px; }
        .display-none { display: none; }
        .mt10 { margin-top: 10px; }
        .mt20 { margin-top: 20px; }
        .clearfix { clear: both; }
        .cropper-content { height: 420px; width: 100%; clear: both; }
    </style>
    @yield('css_head')

    <!-- JS Head -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var urlBase = "{{ route('home') }}";
    </script>
    @yield('js_head')
</head>
<body>
    <!-- Content -->
    <div class="clearfix" id="app-content">
        @include('noonic_image::message')

        @yield('content')
    </div>

    <!-- JS Bottom -->
    @yield('js_bottom')
</body>
</html>