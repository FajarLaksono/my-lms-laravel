@extends('_assets.layout.single')
@section('page_title', '- Pengguna')

@section('content')
    <div class="row">
        @foreach($users as $user)
            <div class="col-lg-4 col-sm-6 portfolio-item text-center" style="margin-bottom:1rem">
                  <div class="card"><br/>
                        <div class="card-img-top">
                           <img src="{{ !empty($user->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value'])?url('media/images/'.$user->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value']):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block rounded-circle" style="object-fit:cover; object-position:center;width:200px; height:200px;">
                        </div>
                        <div class="card-body">
                              <h4 class="card-title">
                                  <a href="/user/{{$user->id}}">{{$user->name}}</a>
                              </h4>
                              <!--<p class="card-text">{!!substr($user->user_meta->where('meta_key', 'user_bio')->first()['meta_value'], 0, 50)!!}{{$user->user_meta->where('meta_key', 'user_bio')->first()['meta_value']>50 ?'...':''}}</p>
                        --></div>
                  </div>
            </div>
        @endforeach
    </div>
    </br>
    <div class="text-center">
      {!! $users->links() !!}
    </div>
@endsection
