@extends('_assets.layout.single')
@section('page_title', '- Sunting Kursus')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
               <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
               <li class="breadcrumb-item active"><a href="#">Sunting</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Sunting Kursus</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('course.update', $course->id )}}" enctype="multipart/form-data">
                               <div class="row alert alert-info">
                                    <div class="col">
                                        <dl>
                                            <dt style="margin-top:1rem;">Dibuat pada : </dt> <dl>{{$course->created_at}}</dl>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl>
                                            <dt style="margin-top:1rem;">Terakhir Diperbaharui pada : </dt> <dl>{{$course->updated_at}}</dl>
                                        </dl>
                                    </div>
                               </div>
                               <fieldset>
                                   <div class="form-group">
                                        <label for="title"><b>Judul :</b></label>
                                        <input class="form-control" placeholder="Title" name="title" type="text" value='{{ empty(old('title'))? $course->title : old('title') }}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>URL :</b></label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                {{route('course.index')}}/
                                            </div>
                                            <div class="col">
                                                <input class="form-control" placeholder="Slug" name="slug" type="text" value='{{ empty(old('slug'))? $course->slug : old('slug') }}'>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="image"><b>Gambar :</b> (Pilih gambar jika ingin mengganti gambar sebelumnya.)</label>
                                       <input class="form-control" type="file" name="image">
                                   </div>
                                   <div class="form-group">
                                        <label for="description"><b>Description :</b></label>
                                        <textarea class="form-control" placeholder="Description" name="description" rows="15" cols="80">{{ empty(old('description'))? $course->description : old('description') }}</textarea>
                                   </div>
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
