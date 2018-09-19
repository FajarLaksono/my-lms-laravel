@extends('_assets.layout.single')
@section('page_title', ' - '.$lesson->title.' - '.$course->title)

@section('content')
<div class="container">
  <div class="row">
      <div class="card h-100 col-md-10 mx-auto">
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="{{route('course.index')}}">Course</a></li>
             <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
             <li class="breadcrumb-item active"><a href="#">{{$lesson->title}}</a></li>
          </ol>
          @if( !empty($lesson->image) )
          <div class="card-img-top">
             <img src="{{ url('media/images/'.$lesson->image) }}" class="img-fluid">
          </div>
          @endif
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="align-middle card-title panel-heading">
                          <h3 class="panel-title">{{$lesson->title}}</h3>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="container">
                                  {!!$lesson->full_text!!}
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 text-center">
                              <div class="btn-group mx-auto">
                                  <a href="{{route('lesson.show', [$course->slug, $prev_lesson['slug']])}}" class="btn btn-primary btn-lg {{ empty($prev_lesson) ? 'disabled' : '' }}"><b>Sebelumnya</b><br/>{{$prev_lesson['title']}}</a>
                                  <a href="{{route('course.show', $course->slug)}}" class="btn btn-success btn-lg">List</a>
                                  <a href="{{route('lesson.show', [$course->slug, $next_lesson['slug']])}}" class="btn btn-primary btn-lg {{ empty($next_lesson) ? 'disabled' : '' }}"><b>Selanjutnya</b><br/>{{$next_lesson['title']}}</a>
                              </div>
                          </div>
                      </div>
                      <br/>
                      <div class="row">
                          <div class="col-md-12">
                              @if(count($lesson->test()->get()))
                                  <h4>Ujian untuk pelajaran ini</h4>
                                  <table class="table">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th>Nomer</th>
                                              <th>Judul</th>
                                              <th width="200px">Aksi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($lesson->test()->orderBy('position', 'asc')->get() as $test)
                                          <tr>
                                              <td>{{$test->position}}</td>
                                              <td>{{$test->title}}</td>
                                              <td><a href="{{route('test.show', [$course->slug, $lesson->slug, $test->slug])}}" class="btn btn-warning btn-sm"><i class="fa fa-play" aria-hidden="true"></i> Mulai</a></td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              @endif
                          </div>
                      </div>
                      <div class="row alert alert-info">
                           <div class="col">
                               <dl>
                                   <dt style="margin-top:1rem;">Dibuat pada : </dt> <dl>{{$lesson->created_at}}</dl>
                               </dl>
                           </div>
                           <div class="col">
                               <dl>
                                   <dt style="margin-top:1rem;">Terakhir Diperbaharui pada : </dt> <dl>{{$lesson->updated_at}}</dl>
                               </dl>
                           </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
