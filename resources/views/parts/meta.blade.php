@if (env('APP_ENV') == 'prod' || env('APP_ENV') == 'production')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123427982-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-123427982-1');
    </script>
@endif

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Base URL -->
<meta name="base-url" content="{{ url("/") }}">

<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">

@include('parts.font-awesome')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon }}">
<link rel="mask-icon" href="{{ $favicon }}">
<link rel="shortcut icon" href="{{ $favicon }}"> --}}
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
