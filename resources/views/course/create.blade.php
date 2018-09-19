@extends('_assets.layout.single')
@section('page_title', '- Buat Kursus Baru')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
               <li class="breadcrumb-item active"><a href="#">Baru</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Membuat Kursus Baru</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('course.store')}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <label for="title"><b>Judul :</b></label>
                                        <input class="form-control" placeholder="Judul" name="title" type="text" value='{{old('title')}}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="slug"><b>URL :</b></label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                {{route('course.index')}}/
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" placeholder="Slug" name="slug" type="text" value='{{old('slug')}}'>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="image"><b>Gambar :</b></label>
                                       <input class="form-control" type="file" name="image">
                                      </script>
                                   </div>


                                   <div class="form-group">
                                        <label for="description"><b>Keterangan :</b></label>
                                        <textarea class="form-control" placeholder="Description" name="description" rows="15" cols="80">{{old('description')}}</textarea>
                                   </div>
                                   {{ csrf_field() }}
                                   <input type="submit" value="&#xf0c7; Buat" class="btn btn-lg btn-success fa">
                                   <a href="{{route('home')}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
                               </fieldset>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
     </div>
  </div>
@endsection
