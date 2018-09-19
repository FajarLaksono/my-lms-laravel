@extends('_assets.layout.single')
@section('page_title', '- '.$user->name)
@section('content')
    <div class="container">
      <div class="row">
          <div class="card h-100 col-md-10 mx-auto">
              <div class="card-body">
                     <div class="login-panel panel panel-default">
                         <div class="card-title panel-heading">

                         </div>
                         <div class="card-form panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                   <img src="{{ !empty($user->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value'])?url('media/images/'.$user->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value']):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block img-thumbnail" style="object-fit:cover; object-position:center;width:200px; height:200px;">
                                    @if(Auth::User()->id == $user->id)
                                      <a href="{{route('user.setting', [Auth::user()->id, 'information'])}}" class="btn btn-warning btn-block btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Sunting Informasi</a>
                                    @else
                                      <a href="{{route('message.show', $user->id)}}" class="btn btn-info btn-block btn-md"><i class="fa fa-envelope" aria-hidden="true"></i> Kirim Pesan</a>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <dl>
                                        <dt>Name :</dt> <dd>{{$user->name}}</dd>
                                        <dt>Bio :</dt> <dd>{!! empty($user->user_meta->where('meta_key', 'user_bio')->first()['meta_value'])?'(Kosong)':$user->user_meta->where('meta_key', 'user_bio')->first()['meta_value'] !!}</dd>
                                        <dt>Email :</dt> <dd>{{ empty($user->user_meta->where('meta_key', 'user_bio')->first()['meta_value'])?'(Kosong)':$user->user_meta->where('meta_key', 'user_email')->first()['meta_value'] }}</dd>
                                        <dt>Website :</dt> <dd>{!! empty($user->user_meta->where('meta_key', 'user_bio')->first()['meta_value'])?'(Kosong)':$user->user_meta->where('meta_key', 'user_website')->first()['meta_value'] !!}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
    </div>
</div>
@endsection
