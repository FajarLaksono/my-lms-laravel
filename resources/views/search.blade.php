@extends('_assets.layout.single')
@section('page_title', '- Cari : '.$key)
@section('content')
    <br>
    <div class="row">
        @if(!$results->isEmpty())
            @foreach($results as $result)
                <div class="col-lg-4 col-sm-6 portfolio-item {{$cat=='user'?'text-center':''}}" style="margin-bottom:1rem">
                      <div class="card">
                            @if($cat == 'user')
                                <br/>
                            @endif
                            <div class="card-img-top">
                                @if($cat == 'user')
                                    <img src="{{ !empty($result->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value'])?url('media/images/'.$result->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value']):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block rounded-circle" style="object-fit:cover; object-position:center;width:200px; height:200px;">
                                @else
                                    <img src="{{ !empty($result->image)?url('media/images/'.$result->image):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block" style="object-fit:cover; object-position:center;width:100%; height:200px;">
                                @endif
                            </div>
                            <div class="card-body">
                                  @if($cat == 'user')
                                      <h4 class="card-title">
                                          <a href="/user/{{$result->id}}">{{$result->name}}</a>
                                      </h4>
                                  @else
                                      <h4 class="card-title">
                                          <a href="{{route('course.show', $result->slug)}}">{{$result->title}}</a>
                                      </h4>
                                      <p class="card-text">{!!substr(strip_tags($result->description), 0, 50)!!}{{strlen(strip_tags($result->description))>50 ?'...':''}}</p>
                                  @endif
                            </div>
                      </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12 text-center">
                <h4 class="text-center">
                    Ooops, Kami tidak menemukan apapun.
                </h4>
            </div>
        @endif
    </div>
    </br>
    <div class="text-center">
      {!! $results->links() !!}
    </div>
@endsection
