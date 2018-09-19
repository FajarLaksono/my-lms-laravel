@extends('_assets.layout.single')
@section('page_title', 'Mengatur Keamanan Akun')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-7 mx-auto">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'information'])}}">Informasi</a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'security'])}}">Keamanan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'destroy'])}}">Hapus Akun</a>
                  </li>
                </ul>
            </nav>
            <div class="card-body">
               <div class="card-title panel-heading">
                   <h3 class="panel-title">Mengatur Keamanan Akun</h3>
               </div>
               <div class="card-form panel-body">
                   <form role="form" method="POST" action="{{route('user.saveSetting', [Auth::user()->id, 'security'])}}" enctype="multipart/form-data">
                       <fieldset>
                           <div class="form-group">
                                <label for="name">Email :</label>
                                <input class="form-control" placeholder="Your email" name="email" type="text" value='{{empty(old('email'))? Auth::user()->email : old('email')}}' autofocus>
                           </div>
                           <hr>
                           <label for="name">Ganti Password : (isi jika ingin ganti)</label>
                           <div class="form-group">
                               <input class="form-control" placeholder="New password" name="new_pass" type="password" value='{{old('new_pass')}}'>
                           </div>
                           <div class="form-group">
                               <input class="form-control" placeholder="Confirm new password" name="conf_new_pass" type="password" value='{{old('conf_new_pass')}}'>
                           </div>
                           <hr>
                           <label for="name">Membutuhkan password anda : (Setiap aksi)</label>
                           <div class="form-group">
                               <input class="form-control" placeholder="Password" name="password" type="password" value='{{old('password')}}'>
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
