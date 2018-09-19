@extends('_assets.layout.single')
@section('page_title', ' - Welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="jumbotron">
                                <h1>Welcome</h1>
                                <p class"lead"><i>Share, Accelerate your future. Learn anytime, anywhere for free.</i></p>
                                <hr class="my-4">
                                <p><i>Web</i> Aplikasi <i>Learning Management System</i> dibuat dengan tujuan mempermudah kegiatan belajar mengajar, anda dibebaskan untuk membagi pelajaran atau belajar apapun, kapanpun dan dimanapun secara gratis.</p>
                                <a class="btn btn-primary btn-lg" href="{{route('course.index')}}" role="button"><i class="fa fa-globe" aria-hidden="true"></i> Jelajah untuk kursus baru</a>
                                <a class="btn btn-success btn-lg" href="{{route('course.create')}}" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> Buat Kursus</a>
                                <a class="btn btn-danger btn-lg" href="{{route('tutorial')}}" role="button"><i class="fa fa-question-circle" aria-hidden="true"></i> Tutorial</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($role))
                    @if(!empty(count($role->where('role_status', 'admin'))))
                    <!--<div class="row">-->
                        <!--//Your course-->
                        <div class="col-md-11 mx-auto">
                            <!--<div class="card">-->
                                <h3>Kursus Milik Anda</h3>
                                <!--<div class="card-header">Kursus milik anda</div>-->
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Dibuat pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role->where('role_status', 'admin') as $admin)
                                            <tr>
                                                <td><a href="{{route('course.show', $admin->course->slug)}}" class="btn btn-link">{{$admin->course->title}}</a></td>
                                                <td>{{$admin->course->created_at}}</td>
                                            </tr>
                                        @endforeach
                                  </tbody>
                                </table>
                            <!--</div>-->
                        </div>
                    <!--</div>-->
                    @endif
                    @if(!empty(count($role->where('role_status', 'student'))))
                    <!--//Your Course you follow-->
                    <!--<div class="row">-->
                        <!--//Your course-->
                        <div class="col-md-11 mx-auto">
                            <!--<div class="card">-->
                                <h3>Kursus yang Anda Ikuti</h3>
                                <!--<div class="card-header">Kursus milik anda</div>-->
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Dibuat pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role->where('role_status', 'student') as $student)
                                            <tr>
                                                <td><a href="{{route('course.show', $student->course->slug)}}" class="btn btn-link">{{$student->course->title}}</a></td>
                                                <td>{{$student->course->created_at}}</td>
                                            </tr>
                                        @endforeach
                                  </tbody>
                                </table>
                            <!--</div>-->
                        </div>
                    <!--</div>-->
                    @endif
                    @if(!empty(count($role->where('role_status', 'nothing'))))
                    <!--//Your graduation cup-->
                    <!--<div class="row">-->
                        <!--//Your course-->
                        <div class="col-md-11 mx-auto">
                            <!--<div class="card">-->
                                <h3>Bukti Lulus</h3>
                                <!--<div class="card-header">Kursus milik anda</div>-->
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Dibuat pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role->where('role_status', 'admin') as $admin)
                                            <tr>
                                                <td><a href="{{route('course.show', $admin->course->slug)}}" class="btn btn-link">{!!$admin->course->title!!}</a></td>
                                                <td>{{$admin->course->created_at}}</td>
                                            </tr>
                                        @endforeach
                                  </tbody>
                                </table>
                            <!--</div>-->
                        </div>
                    <!--</div>-->
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
