<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @yield('web_title')
    @include('_assets.inc.head')
  </head>
  <body>
    @include('_assets.partial.navbar')
    @yield('content')
    @include('_assets.partial.sidebar')
    @include('_assets.partial.footer')
    @include('_assets.inc.foot')
  </body>
</html>
