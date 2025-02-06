<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{{\Storage::url('favicon/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{\Storage::url('favicon/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{\Storage::url('favicon/apple-touch-icon-180x180.png')}}">
    @include('layouts.admin.includes.styles')
</head>
<body>
<div id="page-container" class="main-content-boxed">
    @yield('content')
</div>@include('layouts.admin.includes.scripts')
</body>
</html>
