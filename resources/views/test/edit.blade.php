@extends('_assets.layout.single')
@section('page_title', 'Sunting Ujian')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
               <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
               <li class="breadcrumb-item"><a href="{{route('lesson.show', [$course->slug, $lesson->slug])}}">{{$lesson->title}}</a></li>
               <li class="breadcrumb-item"><a href="{{route('test.show', [$course->slug, $lesson->slug, $test->slug])}}">{{$test->title}}</a></li>
               <li class="breadcrumb-item active"><a href="#">Sunting</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Sunting Ujian</h3>
                       </div>

                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('test.update', [$course->id, $lesson->id, $test->id])}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <label for="title"><b>Judul : </b></label>
                                        <input class="form-control" placeholder="Judul" name="title" type="text" value='{{ empty(old('title'))? $test->title : old('title') }}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>URL : </b></label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                {{route('test.index', [$course->slug, $lesson->slug])}}/
                                            </div>
                                            <div class="col">
                                                <input class="form-control" placeholder="Slug" name="slug" type="text" value='{{ empty(old('slug'))? $test->slug : old('slug') }}'>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="position"><b>Posisi : </b></label>
                                        <input class="form-control" placeholder="Posisi" name="position" type="number" value='{{ empty(old('position'))? $test->position : old('position') }}'>
                                   </div>
                                   <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
                                        <textarea class="form-control" placeholder="Keterangan" name="description" rows="9" cols="80">{{ empty(old('description'))? $test->description : old('description') }}</textarea>
                                   </div>
                                   {{ csrf_field() }}
                                   <!-- Change this to a button or input when using this as a form -->
                                   <input type="submit" value="&#xf0c7; Buat" class="btn btn-lg btn-success fa">
                                   <a href="{{route('course.show', $course->slug)}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
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
