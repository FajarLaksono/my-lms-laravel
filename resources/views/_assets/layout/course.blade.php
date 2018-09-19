<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        @yield('web_title')
        @include('_assets.inc.head')
    </head>
    <body>
        @include('_assets.partial.navbar')
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    @yield('content')
                </div>
                <div class="col-md-5">
                    <div class="card col-md-12 mx-auto">
                        <div class="card-body">
                            @yield('sidebar')
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @yield('lesson')
                </div>
            </div>
        </div>
        @include('_assets.partial.footer')
        @include('_assets.inc.foot')
    </body>
</html>
