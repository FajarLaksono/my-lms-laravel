@extends('_assets.layout.single')
@section('page_title', 'Pilih Pelajaran untuk membuat Ujian baru')
@section('content')
<div class="container">
  <div class="row">
      <div class="card h-100 col-md-9 mx-auto">
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
             <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
             <li class="breadcrumb-item">Buat Ujian Baru</li>
             <li class="breadcrumb-item active">Pilih Pelajaran</li>
          </ol>
          <div class="card-body">
              <div class="row">
                <div class="align-middle card-title panel-heading">
                    <h3 class="panel-title">Pilih pelajaran untuk membuat ujian</h3>
                </div>
                @if( count($lessons) > 0 )
                    <table class="table">
                        <tr>
                            <th>Nomer</th>
                            <th>Judul</th>
                            <th width="200px">Aksi</th>
                        </tr>

                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->position}}</td>
                                <td>{{$lesson->title}}</td>
                                <td><a class="btn btn-success btn-sm" href="{{route('test.create', [$course->id, $lesson->id])}}">Pilih <i class="fa fa-arrow-right" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <br>
                    <div class="alert alert-danger col-md-12">Belum ada Pelajaran, <a class="" href="{{route('lesson.create', [$course->id])}}">Buat pelajaran</a></div>
                    <a href="{{route('course.show', $course->slug)}}" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                @endif
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
