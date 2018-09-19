@extends('_assets.layout.single')
@section('page_title', '- Kursus')

@section('content')
    <div class="row">
        @foreach($courses as $course)
            <div class="col-lg-4 col-sm-6 portfolio-item" style="margin-bottom:1rem">
                  <div class="card">
                        <div class="card-img-top">
                           <img src="{{ !empty($course->image)?url('media/images/'.$course->image):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block" style="object-fit:cover; object-position:center;width:100%; height:200px;">
                        </div>
                        <div class="card-body">
                              <h4 class="card-title">
                                  <a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a>
                              </h4>

                              <p class="card-text">{!! substr(strip_tags($course->description), 0, 50)!!}{{strlen(strip_tags($course->description))>50 ?'...':''}}</p>
                        </div>
                  </div>
            </div>
        @endforeach
    </div>
    </br>
    <div class="text-center">
      {!! $courses->links() !!}
    </div>
@endsection
