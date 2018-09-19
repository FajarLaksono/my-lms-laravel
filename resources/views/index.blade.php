@extends('_assets.layout.frontpage')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="text-center align-center">Kursus Terbaru</h3>
            <hr class="my-4">
        </div>
    </div>
    <div class="row">
        @foreach($courses as $course)
            <div class="col-lg-4 col-sm-6 portfolio-item" style="margin-bottom:1rem">
                  <div class="card">
                        <img src="{{ !empty($course->image)?url('media/images/'.$course->image):url('media/images/default-user.png') }}" class="img-fluid img-resposive center-block" style="object-fit:cover; object-position:center;width:100%; height:200px;">
                        <div class="card-body">
                              <h4 class="card-title">
                                  <a href="{{ url('/course/'.$course->slug) }}">{{$course->title}}</a>
                              </h4>
                              <p class="card-text">{!! substr(strip_tags($course->description), 0, 50) !!}{{strlen(strip_tags($course->description))>50 ?'...':''}}</p>
                        </div>
                  </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('course.index') }}" class="btn btn-lg btn-block btn-outline-secondary">Lihat semua</a>
        </div>
    </div>
    </br>
@endsection
