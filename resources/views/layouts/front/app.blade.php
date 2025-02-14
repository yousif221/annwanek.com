<!doctype html>
<html lang="en">
  <head>
    
    @include('layouts.front.includes.links')
    <title>@yield('title') | {{ getConfig('website_name') }}</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset(getConfig('favicon')) }}">
  </head>
  <body>
    @include('layouts.front.includes.templates.header')
    @yield('content')

    @include('layouts.front.includes.templates.footer')
  </body>
</html>