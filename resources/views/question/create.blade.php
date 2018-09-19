@extends('_assets.layout.single')
@section('page_title', 'Buat Pertanyaan Baru')

@section('content')
  </br>
  @include('_assets.inc.notiferror')
  <div class="container">
    <div class="row">
        <div class="card h-100 col-md-9 mx-auto">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
               <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
               <li class="breadcrumb-item"><a href="{{route('lesson.show', [$course->slug, $lesson->slug])}}">{{$lesson->title}}</a></li>
               <li class="breadcrumb-item"><a href="{{route('test.show', [$course->slug, $lesson->slug, $test->slug])}}">{{$test->title}}</a></li>
               <li class="breadcrumb-item active"><a href="#">Pertanyaan Baru</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Buat Pertanyaan Baru</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('question.store', [$course->id, $lesson->id, $test->id])}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <label for="question_score"><b>Nilai :</b></label>
                                        <input class="form-control" placeholder="Nilai Pertanyaan (default: 10)" name="question_score" type="number" value="{{ old('score') }}" autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="question_text"><b>Pertanyaan :</b></label>
                                        <textarea class="form-control" placeholder="Pertanyaan" name="question_text" rows="9" cols="80" required> {{ old('question_text') }} </textarea>
                                   </div>

                                   <label><h5>Jawaban :</h5></label>
                                   <div class="form-group">
                                        <label for="answer_text1" class="text-success"><b>Jawaban Benar :</b></label>
                                        <input class="form-control" placeholder="Jawaban" name="answer_text1" type="text" value="{{old('answer_text1')}}" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="answer_text2" class="text-danger"><b>Jawaban Salah :</b></label>
                                        <input class="form-control" placeholder="Jawaban" name="answer_text2" type="text" value="{{old('answer_text2')}}" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="answer_text3" class="text-danger"><b>Jawaban Salah :</b></label>
                                        <input class="form-control" placeholder="Jawaban" name="answer_text3" type="text" value="{{old('answer_text3')}}" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="answer_text4" class="text-danger"><b>Jawaban Salah :</b></label>
                                        <input class="form-control" placeholder="Jawaban" name="answer_text4" type="text" value="{{old('answer_text4')}}" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="answer_text5" class="text-danger"><b>Jawaban Salah :</b></label>
                                        <input class="form-control" placeholder="Jawaban" name="answer_text5" type="text" value="{{old('answer_text5')}}" required>
                                   </div>
                                   {{ csrf_field() }}
                                   <input type="submit" value="&#xf0c7; Buat" class="btn btn-lg btn-success fa">
                                   <a href="{{route('test.show', [$course->slug, $lesson->slug, $test->slug])}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
                               </fieldset>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
     </div>
  </div>
@endsection
