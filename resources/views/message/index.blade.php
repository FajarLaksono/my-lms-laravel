@extends('_assets.layout.single')
@section('page_title', '- Message')
@section('content')
    <div class="container">
      <div class="row">
          <div class="card h-100 col-md-10 mx-auto">
              <div class="card-body">
                     <div class="login-panel panel panel-default">
                         <div class="card-title panel-heading">
                              <h3 class="panel-title">Pesan anda</h3>
                         </div>
                         <div class="card-form panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="POST" action="{{route('search', 'user')}}" class="form-inline my-2 my-lg-0 mr-auto">
                                        <input name="key" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="submit" value="&#xf002;" class="btn btn-outline-primary my-2 my-sm-0 fa">
                                        <!--<button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>-->
                                    </form>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="80px">Foto</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th width="100px">Aksi</th>
                                            <tr>
                                        <thead>
                                        <tbody>
                                            <?php $readed = array();?>
                                            @foreach($messages as $message)
                                                <?php $target = $message->to == Auth::User()->id ? $message->from : $message->to ?>
                                                @if(!in_array($target, $readed))
                                                    <tr>
                                                        <?php array_push($readed, $target);?>
                                                        <td>
                                                            <img src="{{ !empty($users[$target]['user_display_picture']) ? url('media/images/'.$users[$target]['user_display_picture']):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block rounded-circle" style="object-fit:cover; object-position:center;width:50px; height:50px;">
                                                        </td>
                                                        <td>
                                                            {{$users[$target]['name']}}
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <a href="{{route('message.show', $target)}}" class="btn btn-primary btn-sm">Buka</a>
                                                        </td>
                                                    <tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
