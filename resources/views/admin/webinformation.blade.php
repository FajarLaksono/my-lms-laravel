@extends('_assets.layout.single')
@section('page_title', '- Admin Area : Edit Web Information')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Ubah Informasi Web</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('webinfo.store')}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <label for="title"><b>Judul Web :</b></label>
                                        <input class="form-control" placeholder="Title" name="title" type="text" value='{{ empty(old('title'))? empty($web_info['web_title'])?'':$web_info['web_title'] : old('title') }}' autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="title"><b>Keterangan :</b></label>
                                        <input class="form-control" placeholder="Description" name="description" type="text" value='{{ empty(old('description'))? empty($web_info['web_description'])?'':$web_info['web_description'] : old('description') }}' autofocus>
                                   </div>

                                   <input type="submit" value="&#xf0c7; Simpan" class="btn btn-lg btn-success fa">
                                   <a href="{{route('home')}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Kembali</a>
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
