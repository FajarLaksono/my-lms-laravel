@extends('_assets.layout.single')
@section('page_title', '- Hapus Akun ini')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-6 mx-auto">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'information'])}}">Informasi</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'security'])}}">Keamanan</a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="{{route('user.setting', [Auth::user()->id, 'destroy'])}}">Hapus Akun</a>
                  </li>
                </ul>
            </nav>
            <div class="card-body">
               <div class="card-title panel-heading">
                   <h3 class="panel-title">Hapus Akun ini</h3>
               </div>
               <div class="card-form panel-body">
                   <form role="form" method="POST" action="{{route('user.saveSetting', [Auth::user()->id, 'destroy'])}}" enctype="multipart/form-data">
                       <fieldset>
                           <label for="name">Membutuhkan password anda untuk melanjutkan :</label>
                           <div class="form-group">
                               <input class="form-control" placeholder="Password" name="password" type="password" value="{{old('password')}}">
                           </div>
                           {{ csrf_field() }}
                           <input type="hidden" name="_method" value="PUT">
                           <!-- Change this to a button or input when using this as a form -->
                           <input class="btn btn-lg btn-block btn-danger fa" type="submit" name="delete" value="&#xf1f8; Hapus">
                       </fieldset>
                   </form>
               </div>
           </div>
        </div>
     </div>
  </div>
@endsection
