<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
  <head>
    @include('_assets.inc.head')
  </head>
  <body>
    @include('_assets.partial.navbar')

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="jumbotron">
            <h1>Welcome</h1>
            <p class"lead"><i>Share, Accelerate your future. Learn anytime, anywhere for free.</i></p>
            <hr class="my-4">
            <p><i>Web</i> Aplikasi <i>Learning Management System</i> dibuat dengan tujuan mempermudah kegiatan belajar mengajar, anda dibebaskan untuk membagi pelajaran atau belajar apapun, kapanpun dan dimanapun secara gratis.</p>
            @guest
                <p>
                    <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('course.index') }}" role="button"><i class="fa fa-list" aria-hidden="true"></i> Jelajaih Kursus</a>
                </p>
            @else
                <p><a class="btn btn-primary btn-lg" href="{{ route('course.index') }}" role="button"><i class="fa fa-list" aria-hidden="true"></i> Explore Courses</a></p>
            @endguest
          </div>
        </div>
      </div>
      @yield('content')
    </div>
    <!-- /.container -->

    @include('_assets.partial.footer')
    @include('_assets.inc.foot')
  </body>
</html>
