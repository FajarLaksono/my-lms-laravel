@extends('_assets.layout.single')
@section('page_title', 'Sunting Pertanyaan')

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
                 <li class="breadcrumb-item active"><a href="#">Sunting Pertanyaan</a></li>
            </ol>
            <div class="card-body">
                   <div class="login-panel panel panel-default">
                       <div class="card-title panel-heading">
                           <h3 class="panel-title">Sunting Pertanyaan</h3>
                       </div>
                       <div class="card-form panel-body">
                           <form role="form" method="POST" action="{{route('question.update', [$course->id, $lesson->id, $test->id, $question->id])}}" enctype="multipart/form-data">
                               <fieldset>
                                   <div class="form-group">
                                        <label for="question_score"><b>Nilai :</b></label>
                                        <input class="form-control" placeholder="Nilai Pertanyaan (default: 10)" name="question_score" type="number" value="{{ empty(old('score'))? number_format($question->score, 0) : old('score') }}" autofocus>
                                   </div>
                                   <div class="form-group">
                                        <label for="question_text"><b>Pertanyaan :</b></label>
                                        <textarea class="form-control" placeholder="Pertanyaan" name="question_text" rows="9" cols="80" required>{{ empty(old('question_text'))? $question->text : old('question_text') }}</textarea>
                                   </div>

                                   <label><h5>Jawaban :</h5></label>
                                   @for($i=0; $i < count($answers); $i++)
                                       <div class="form-group">
                                            <label for="answers[{{$i}}]" {!! $answers[$i]['correct']?'class="text-success"><b>Jawaban Benar :</b>': 'class="text-danger"><b>Jawaban Salah</b>' !!} </label>
                                            <input class="form-control" name="answers[{{$i}}][id]" type="hidden" value="{{ $answers[$i]['id'] }}">
                                            <input class="form-control" placeholder="Jawaban" name="answers[{{$i}}][text]" type="text" value="{{ empty(old('answer_text[$i]'))? $answers[$i]['text'] : old('answer_text[$i]') }}" required>
                                            <input class="form-control" name="answers[{{$i}}][correct]" type="hidden" value="{{ $answers[$i]['correct'] }}">
                                       </div>
                                   @endfor

                                   {{ csrf_field() }}
                                   <input type="hidden" name="_method" value="PUT">
                                   <input type="submit" value="&#xf0c7; Simpan" class="btn btn-lg btn-success fa">
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
