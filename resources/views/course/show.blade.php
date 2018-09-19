@extends('_assets.layout.course')
@section('page_title', ' - '.$course->title)

@section('content')
    <div class="row">
        @if( !empty($course->image) )
        <div class="card-img-top">
           <img src="{{ url('media/images/'.$course->image) }}" class="img-fluid">
        </div>
        @endif
        <div class="card h-100 col-md-12 mx-auto">
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h1 class="panel-title">{{$course->title}}</h1>
                       </div>
                       <div class="card-form panel-body">
                           <p>{!!$course->description!!}</p>
                       </div>
                   </div>
            </div>
        </div>
    </div>
@endsection
@section('lesson')
    <div class="row">
        <div class="card h-100 col-md-12 mx-auto">
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading" style="margin-bottom:1rem; display:flow-root;position: relative;height: auto;">
                            <span class="h3 panel-title float-left">Kurikulum</span>
                            <div class="btn-group float-right">
                                @guest
                                    <!-- -->
                                @else
                                    @if( auth::user()->getCourseRole($course->id) == null )
                                        <!-- -->
                                    @elseif( auth::user()->getCourseRole($course->id) == 'student' ) <?php //Possibly will be buggy ?>
                                        <!-- -->
                                    @else
                                      <a href="{{route('lesson.create', $course->id)}}" class="btn btn-lg btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Tambah Pelajaran</a>
                                      <a href="{{route('test.selectLesson', $course->id)}}" class="btn btn-lg btn-info">Tambah Ujian</a>
                                    @endif
                                @endguest
                            </div>
                       </div>
                       <div class="card-form panel-body">
                         <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Keterangan</th>
                                    @auth
                                        @if(auth::user()->getCourseRole($course->id) != null)
                                            <th width="200px">Aksi</th>
                                        @endif
                                    @endauth
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach($lessons as $lesson)
                                        <tr>
                                            <td>{{$lesson['position']}}</td>
                                            <td>{{$lesson['title']}}</td>
                                            <td>{!!$lesson['short_text']!!}</td>
                                            @auth
                                                @if( auth::user()->getCourseRole($course->id) != NULL )
                                                      <td>
                                                            <div class="btn-group">
                                                                    <!--<button type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-sign-in" aria-hidden="true"></i> Enroll Sekarang</button>-->
                                                                @if( auth::user()->getCourseRole($course->id) == 'student' ) <?php //Possibly will be buggy ?>
                                                                    <a href="{{route('lesson.show', [$course->slug, $lesson->slug])}}" class="btn btn-success btn-block btn-sm"><i class="fa fa-play" aria-hidden="true"></i> Mulai</a>
                                                                @else
                                                                    <a href="{{route('lesson.show', [$course->slug, $lesson['slug'] ])}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                                                                    <a href="{{route('lesson.edit', [$course->id, $lesson['id'] ])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> Sunting</a>
                                                                    <form action="{{route('lesson.destroy', [$course->id, $lesson['id'] ])}}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input class="btn btn-sm btn-danger fa" type="submit" name="delete" value="&#xf1f8; Hapus">
                                                                    </form>
                                                                @endif
                                                            </div>
                                                      </td>
                                                @endif
                                            @endauth
                                        </tr>

                                        <?php $curr_tests = $tests->where('lesson_id', $lesson->id)->sortBy('position') ?>
                                        @if( count($curr_tests) > 0 )
                                            @foreach ($curr_tests as $test)
                                            <tr class="table-active">
                                                <td></td>
                                                <td>{{$test['title']}}</td>
                                                <td>{!!$test['description']!!}</td>
                                                @auth
                                                    @if( auth::user()->getCourseRole($course->id) != NULL )
                                                        <td>
                                                              <div class="btn-group">
                                                                      <!--<button type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-sign-in" aria-hidden="true"></i> Enroll Sekarang</button>-->
                                                                  @if( auth::user()->getCourseRole($course->id) == 'student' ) <?php //Possibly will be buggy ?>
                                                                      <a href="{{route('test.show', [$course->slug, $lesson->slug, $test->slug])}}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-play" aria-hidden="true"></i> Mulai</a>
                                                                  @else
                                                                      <a href="{{route('test.show', [$course->slug, $lesson['slug'], $test['slug'] ])}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                                                                      <a href="{{route('test.edit', [$course->id, $lesson['id'], $test['id'] ])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> Sunting</a>
                                                                      <form action="{{route('test.destroy', [$course->id, $lesson['id'], $test['id']  ])}}" method="POST">
                                                                          {{ csrf_field() }}
                                                                          <input type="hidden" name="_method" value="DELETE">
                                                                          <input class="btn btn-sm btn-danger fa" type="submit" name="delete" value="&#xf1f8; Hapus">
                                                                      </form>
                                                                  @endif
                                                              </div>
                                                        </td>
                                                    @endif
                                                @endauth
                                            </tr>
                                            @endforeach
                                        @endif

                                    @endforeach
                              </tbody>
                          </table>
                       </div>
                   </div>
            </div>
        </div>
     </div>
@endsection

@section('sidebar')
    <dl>
        <dt>Instructur :</dt> <dd><a href="{{route('user.show', $course->Course_role()->where('role_status', 'admin')->first()->user->id)}}" class="btn btn-link">{{ $course->Course_role()->where('role_status', 'admin')->first()->user->name }}</a></dd>
        <dt>URL :</dt> <dd><a href="{{ url($course->slug) }}" class="btn btn-link">{{ url($course->slug) }} <i class="fa fa-link" aria-hidden="true"></i></a></dd>
        <dt>Jumlah Pelajar :</dt><dd><p class="btn">{{count($course->course_role()->where('role_status', 'student')->get())}} Pelajar</p></dd>
        <hr/>
        <dt>Dibuat pada :</dt> <dd><p class="btn">{{ $course->created_at }}</p></dd>
        <dt>Diperbaharui pada :</dt> <dd><p class="btn">{{ $course->updated_at }}</p></dd>
    </dl>
    @guest
        <a href="{{ route('login') }}" type="button" class="btn btn-danger btn-block btn-lg">Masuk untuk Enroll <i class="fa fa-sign-in" aria-hidden="true"></i></a>
    @else

        @if(auth::user()->getCourseRole($course->id) == 'admin')
            <div class="row">
                <div class="col-md-6">
                    <a href="/course/{{$course->id}}/edit" class="btn btn-warning btn-block"><i class="fa fa-edit" aria-hidden="true"></i> Sunting</a>
                </div>
                <div class="col-md-6">
                    <form action="/course/{{$course->id}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <input class="btn btn-danger btn-block fa" type="submit" name="delete" value="&#xf1f8; Hapus">
                    </form>
                </div>
            </div>
        @elseif( auth::user()->getCourseRole($course->id) == 'student' )
            <a href="{{route('course.result', $course->slug)}}" class="btn btn-success btn-block btn-lg"><i class="fa fa-eye" aria-hidden="true"></i> Lihat hasil</a>
        @else
            <form role="form" method="POST" action="{{route('course.setstudent', $course->slug)}}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="submit" value="&#xf090; Enroll Sekarang" class="btn btn-danger btn-block btn-lg fa">
                <!--<button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>-->
            </form>
        @endif
    @endguest
@endsection
