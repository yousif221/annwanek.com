
<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> {{getConfig('website_name')}} - @yield('title')</title>
    <link rel="shortcut icon" href="{{asset(getConfig('favicon'))}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{\Storage::url('favicon/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{\Storage::url('favicon/apple-touch-icon-180x180.png')}}">
    @include('layouts.admin.includes.styles')
</head>
<body>
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-narrow">

    @include('layouts.admin.template-parts.sidebar')
    @include('layouts.admin.template-parts.header')
    <main id="main-container">
        @yield('content')
    </main>
   
    <footer id="page-footer">
        <div class="content py-20 font-size-sm clearfix">
            <div class="float-right">
                Crafted with <i class="fa fa-heart text-pulse"></i>
            </div>
            <div class="float-left">
                <a class="font-w600" href="{{url('/')}}" target="_blank">{{env('APP_NAME')}}</a> © <span class="js-year-copy js-year-copy-enabled">{{date('Y')}}</span>
            </div>
        </div>
    </footer>
</div>
@include('layouts.admin.includes.scripts')
</body>
</html>
