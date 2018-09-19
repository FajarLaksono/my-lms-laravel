@extends('_assets.layout.single')
@section('page_title', '- Mengatur Informasi Akun')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-7 mx-auto">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'information'])}}">Informasi</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'security'])}}">Keamanan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'destroy'])}}">Hapus Akun</a>
                  </li>
                </ul>
            </nav>

            <div class="card-body">
                   <div class="card-title panel-heading">
                       <h3 class="panel-title">Mengatur Informasi Akun</h3>
                   </div>
                   <div class="card-form panel-body">
                       <form role="form" method="POST" action="{{route('user.saveSetting', [Auth::user()->id, 'information'])}}" enctype="multipart/form-data">
                           <fieldset>
                               <div class="form-group">
                                    <label for="name">Nama :</label>
                                    <input class="form-control" placeholder="Your name" name="name" type="text" value="{{empty(old('name'))? Auth::user()->name : old('name')}}" autofocus>
                               </div>
                               <div class="form-group">
                                    <label for="image">Bio :</label>
                                    <textarea class="form-control" placeholder="Your bio" name="bio" rows="8" cols="80">{{empty(old('bio'))? $user_meta->where('meta_key', 'user_bio')->first()['meta_value'] : old('bio')}}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="image">Gambar :</label>
                                   <input class="form-control" type="file" name="image">
                               </div>
                               <div class="form-group">
                                    <label for="image">Website :</label>
                                    <input class="form-control" placeholder="Your Website" name="website" type="url" value="{{empty(old('website'))? $user_meta->where('meta_key', 'user_website')->first()['meta_value'] : old('website')}}">
                               </div>
                               <div class="form-group">
                                    <label for="image">Email yang ditampilkan :</label>
                                    <input class="form-control" placeholder="Your email" name="email" type="email" value="{{empty(old('email'))? $user_meta->where('meta_key', 'user_email')->first()['meta_value'] : old('email')}}">
                               </div>
                               {{ csrf_field() }}
                               <input type="hidden" name="_method" value="PUT">
                               <!-- Change this to a button or input when using this as a form -->
                               <input type="submit" value="&#xf0c7; Simpan" class="btn btn-lg btn-success btn-block fa">
                           </fieldset>
                       </form>
                   </div>
            </div>
        </div>
     </div>
  </div>
@endsection
