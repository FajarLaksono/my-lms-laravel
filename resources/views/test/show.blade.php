@extends('_assets.layout.single')
@section('page_title', ' - Ujian '.$test->title)

@section('content')
@include('_assets.inc.notiferror')
<div class="container">
  <div class="row">
      <div class="card h-100 col-md-9 mx-auto">
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="{{route('course.index')}}">Kursus</a></li>
             <li class="breadcrumb-item"><a href="{{route('course.show', $course->slug)}}">{{$course->title}}</a></li>
             <li class="breadcrumb-item"><a href="{{route('lesson.show', [$course->slug, $lesson->slug])}}">{{$lesson->title}}</a></li>
             <li class="breadcrumb-item active"><a href="#">{{$test->title}}</a></li>
          </ol>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-9 mr-auto">
                      <div class="align-middle card-title panel-heading">
                          <h3 class="panel-title">{{$test->title}}</h3>
                      </div>
                  </div>
                  @if( auth::user()->getCourseRole($course->id) == 'admin' )
                      <div class="col-md-3 float-right">
                          <a href="{{route( 'question.create', [$course->id, $lesson->id, $test->id] )}}" class="btn btn-lg btn-primary"><i class="fa fa-pencil" aria-hiddedeln="true"></i> Add Question</a>
                      </div>
                  @endif
              </div>

            <div class="row">
                <div class="col-md-12">
                    <p>{!!$test->description!!}</p>
                </div>
            </div>

              <div class="row">
                  <div class="col-md-12">
                      <div class="container">
                          <ol>
							@if( auth::user()->getCourseRole($course->id) == NULL )
									  <!-- -->
							@elseif( auth::user()->getCourseRole($course->id) == 'student' )
								<form action="{{route('test.submit', [$course->slug, $lesson->slug, $test->slug])}}" method='post' enctype="multipart/form-data">
							@else
							  
							@endif
                                  <?php
                                      $totalQuestions = count($questions);
                                      $totalAnswered = 0;
                                      $questionNumber = 0;
                                  ?>
                                  @foreach($questions as $question)
                                      <li>
                                          <!--Questions-->
                                          <input type="hidden" name="question[{{$question['id']}}][id]" value="{{$question['id']}}">
                                          <h4>{!!$question['text']!!}</h4>
                                          <h6 class="text-secondary">Score : {{$question['score']}}</h6>
                                          <div class="radio">
                                              <fieldset id="question[{{$question['id']}}]">
                                                  @foreach( $question->Test_answer()->inRandomOrder()->get() as $answer)
                                                      <label class="{{auth::user()->getCourseRole($course->id) != 'student'?$answer['correct']?'text-success':'text-danger':''}}">
                                                          <input type="radio" name="question[{{$question['id']}}][answer]" value="{{$answer['id']}}">
                                                          {{$answer['text']}}
                                                      </label></br>
                                                      <?php
                                                          if($answer->user_answer()->where('user_id', auth::user()->id)->first() != null){
                                                              $totalAnswered = $totalAnswered+1;
                                                          }
                                                      ?>
                                                  @endforeach
                                              </fieldset>
                                          </div>
                                      </li>
                                      <div class="btn-group">
                                          @if( auth::user()->getCourseRole($course->id) == NULL )
                                              <!-- -->
                                          @elseif( auth::user()->getCourseRole($course->id) == 'student' )
                                              <!-- -->
                                          @else
                                              <a href="{{route('question.edit', [$course->id, $lesson->id, $test->id, $question->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Sunting</a>
                                              <form action="{{route('question.destroy', [$course->id, $lesson->id, $test->id, $question->id])}}" method="POST">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="_method" value="DELETE">
                                                  <input class="btn btn-sm btn-danger fa" type="submit" name="delete" value="&#xf1f8; Hapus">
                                              </form>
                                          @endif
                                      </div>
                                      <hr>
                                  @endforeach

                                  <div class="row">
                                      <div class="col-md-16 mx-auto">
                                          @if( auth::user()->getCourseRole($course->id) == NULL )
                                              <!-- -->
                                          @elseif( auth::user()->getCourseRole($course->id) == 'student' )
                                              {{ csrf_field() }}
                                              <input type="hidden" name="totalquestion" value="{{$totalQuestions}}">
                                              <input type="hidden" name="totalaswered" value="{{$totalAnswered}}">
                                              <input type="hidden" name="_method" value="PUT">
                                              @if($totalQuestions != $totalAnswered)
                                                  <input type="submit" value="&#xf0c7; Ajukan" class="btn btn-lg btn-success fa">
                                              @else
                                                  <a href="{{route('course.result', $course->slug)}}" class="btn btn-lg btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Hasil</a>
                                              @endif
                                          @else

                                          @endif
                                          <a href="{{route('course.show', $course->slug)}}" class="btn btn-lg btn-secondary"><i class="fa fa-times" aria-hidden="true"></i> Kembali</a>
                                      </div>
                                  </div>
								  @if( auth::user()->getCourseRole($course->id) == NULL )
												  <!-- -->
								  @elseif( auth::user()->getCourseRole($course->id) == 'student' )
									  </form>
								  @else
									  
								  @endif
                          </ol>
                      </div>
                  </div>
              </div>


          </div>
      </div>
  </div>
</div>
@endsection
