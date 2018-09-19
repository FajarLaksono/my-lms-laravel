@extends('_assets.layout.single')
@section('page_title', '- Message')
@section('content')
    @include('_assets.inc.notiferror')
    <div class="container">
      <div class="row">
          <div class="card h-100 col-md-10 mx-auto">
              <div class="card-body">
                     <div class="login-panel panel panel-default">
                         <div class="card-title panel-heading">
                              <div class="row">
                                  <div class="col-md-2 text-center">
                                      <img src="{{ !empty($theuser->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value'])?url('media/images/'.$theuser->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value']):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block rounded-circle" style="object-fit:cover; object-position:center;width:50px; height:50px;">
                                  </div>
                                  <div class="col-md-10">
                                      <h3 class="panel-title align-middle mx-auto" style="margin-bottom:0px;">{{$theuser->name}}</h3>
                                  </div>
                              </div>
                              <hr/>
                         </div>
                         <div class="card-form panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty(count($messages)))
                                        <div id="MessageList" class="pre-scrollable bg-secondary" width="100%" style="max-height: 300px;padding:50px; ">
                                            @foreach($messages as $message)
                                                <div class="row">
                                                    <div style="margin-bottom:0.5rem;" class='col-md-12'>
                                                        <div style="width:fit-content; margin-bottom:0.5rem;" class="card {{$message['from']==auth::user()->id?'float-right text-right bg-light':'float-left text-left bg-warning'}}">
                                                            <div class="card-header">{{$message->created_at}}</div>
                                                            <div class="card-body {{$message['from']==auth::user()->id?'':''}}">
                                                                <div>{!!$message->text!!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <script type="text/javascript">
                                            var scrolldiv = document.getElementById("MessageList");
                                            console.log(scrolldiv.scrollHeight);
                                            scrolldiv.scrollTop = scrolldiv.scrollHeight;
                                        </script>
                                    @else
                                        <h3>Tidak ada pesan</h3>
                                    @endif
                                    <hr/>
                                </div>

                                <div class="col-md-12">
                                    <form role="form" method="POST" action="{{route('message.update', [$theuser->id,])}}" enctype="multipart/form-data">
                                        <fieldset>
                                            <label for="name">Kirim pesan :</label>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Ketik pesan baru..." name="new_message" autofocus>{{old('new_message')}}</textarea>
                                            </div>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="PUT">
                                            <!-- Change this to a button or input when using this as a form -->
                                            <input type="submit" value="&#xf1d8; Kirim" class="btn btn-lg btn-success fa">
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
    </div>
</div>
@endsection
