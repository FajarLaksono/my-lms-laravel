@extends('_assets.layout.single')
@section('page_title', '- Buat Pelajaran Baru')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
               <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
               <li class="breadcrumb-item active"><a href="#">Pelajaran Baru</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Membuat Pelajaran Baru</h3>
                       </div>

                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('lesson.store', $course->id)}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <input class="form-control" name="course_id" type="hidden" value='{{ $course->id }}'>
                                   </div>
                                   <div class="form-group">
                                        <label for="title"><b>Judul :</b></label>
                                        <input class="form-control" placeholder="Judul" name="title" type="text" value='{{old('title')}}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>URL :</b></label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                {{route('lesson.index', $course->slug)}}/
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" placeholder="Slug" name="slug" type="text" value='{{old('slug')}}'>
                                            </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="position"><b>Posisi :</b></label>
                                        <input class="form-control" placeholder="Posisi" name="position" type="number" value='{{old('position')}}'>
                                   </div>
                                   <div class="form-group">
                                       <label for="image"><b>Image :</b></label>
                                       <input class="form-control" type="file" name="image">
                                   </div>
                                   <div class="form-group">
                                        <label for="short_text"><b>Keterangan :</b></label>
                                        <textarea class="form-control" placeholder="Keterangan" name="short_text" rows="2" cols="80">{{old('short_text')}}</textarea>
                                   </div>
                                   <div class="form-group">
                                        <label for="full_text"><b>Isi :</b></label>
                                        <textarea class="form-control" placeholder="Isi" name="full_text" rows="15" cols="80">{{old('full_text')}}</textarea>
                                   </div>
                                   {{ csrf_field() }}
                                   <!-- Change this to a button or input when using this as a form -->
                                   <input type="submit" value="&#xf0c7; Buat" class="btn btn-lg btn-success fa">
                                   <a href="{{route('course.show', $course->slug)}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
                               </fieldset>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
     </div>
  </div>
@endsection
