@extends('_assets.layout.single')
@section('page_title', '- Sunting Pelajaran')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Course</a></li>
               <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
               <li class="breadcrumb-item"><a href="{{route('lesson.show', [$course->slug, $lesson->slug])}}">{{$lesson->title}}</a></li>
               <li class="breadcrumb-item active">Sunting</li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Sunting Pelajaran</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('lesson.update', [$course->id, $lesson->id] )}}" enctype="multipart/form-data">
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
                               <fieldset>
                                   <div class="form-group">
                                        <label for="title"><b>Judul :</b></label>
                                        <input class="form-control" placeholder="Judul" name="title" type="text" value='{{ empty(old('title'))? $lesson->title : old('title') }}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>URL :</b></label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                {{route('lesson.index', $course->slug)}}/
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" placeholder="Slug" name="slug" type="text" value='{{ empty(old('slug'))? $lesson->slug : old('slug') }}'>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>Posisi :</b></label>
                                       <input class="form-control" placeholder="Position" name="position" type="number" value='{{ empty(old('position'))? $lesson->position : old('position') }}'>
                                   </div>
                                   <div class="form-group">
                                       <label for="image"><b>Gambar :</b> (Pilih gambar jika ingin mengganti gambar sebelumnya.)</label>
                                       <input class="form-control" type="file" name="image">
                                   </div>
                                   <div class="form-group">
                                        <label for="short_text"><b>Keterangan :</b></label>
                                        <textarea class="form-control" placeholder="Keterangan" name="short_text" rows="2" cols="80">{{ empty(old('short_text'))? $lesson->short_text : old('short_text') }}</textarea>
                                   </div>
                                   <div class="form-group">
                                        <label for="full_text"><b>Isi :</b></label>
                                        <textarea class="form-control" placeholder="Isi" name="full_text" rows="15" cols="80">{{ empty(old('full_text'))? $lesson->full_text : old('full_text') }}</textarea>
                                   </div>
                                   <!-- Change this to a button or input when using this as a form -->
                                   <input type="submit" value="&#xf0c7; Simpan" class="btn btn-lg btn-success fa">
                                   <a href="{{route('course.show', $course->slug)}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
                                   {{ csrf_field() }}
                                   <input type="hidden" name="_method" value="PUT">
                               </fieldset>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
     </div>
  </div>
@endsection
