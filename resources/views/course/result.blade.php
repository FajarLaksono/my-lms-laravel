@extends('_assets.layout.single')
@section('page_title', '- '.$course->title.' : Result')
@section('content')
  <div class="row">
      <div class="card col-md-12 text-justify">
          <div class="card-body">
              <?php
              use App\Http\Controllers\MasterController;
              $web_option = MasterController::getWebInformations();
              $web_title = empty($web_option['web_title']) ? config('app.name', 'LMS') : $web_option['web_title']; ?>
              <div class="row">
                  <div class="col-md-6">
                      <h1 class="text-left">{{$web_title}}</h1>
                  </div>
                  <div class="col-md-6">
                      <h1 class="text-right">SERTIFIKAT</h1>
                      <H6 class="text-right">Dicetak pada {{date("F d, Y")}}</h6>
                  </div>
              </div>
              <div class="row bg-info" style="font-family:arial;font-size:22px;color:white;padding:10px 50px;">
                  <div class="col-md-12">
                      <br>

                      <dl>
                          <dt>Dinyatakan bahwa </dt>
                              <dd style="font-size:35px;margin-left:40px;"><b>{{auth::user()->name}}</b></dd>
                          <dt>Telah mengikuti sebuah kursus yang berjudul </dt>
                              <dd style="font-size:35px;margin-left:40px;"><b>{{$course->title}}</b></dd>
                      </dl>
                      <p style="font-size:18px">Sebuah kursus yang dibuat oleh {{ $course->course_role()->where('role_status', 'admin')->first()->user->name }}, sebuah layanan kursus online.</p>
                      <br>
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <div class="float-right">
                          <div class="text-center">
                              <b>{{ $course->course_role()->where('role_status', 'admin')->first()->user->name }}</b>
                              <h6>Instruktur dari kursus ini<h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <br>
  <div class="row">
      <div class="card col-md-12 text-justify">
          <div class="card-body">
            <h1 class="text-center h1">{{$course->title}}</h1>
            <h6 class="text-center">Instruktur oleh {{ $course->course_role()->where('role_status', 'admin')->first()->user->name }}</h6>

            <p>
                {!! $course->description !!}
            </p>

            <p>Score yang didapatkan oleh <b>{{auth::user()->name}}</b> adalah :</p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Ujian</th>
                        <th>Score yang tersedia</th>
                        <th>Score yang didapat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $all_totalScore = 0;
                        $all_getUserScore = 0;
                    ?>
                    @foreach($lessons as $lesson)
                        @foreach($lesson->test()->orderBy('position')->get() as $test)
                            <tr>
                                <td width="100px">{{$test->position}}</td>
                                <td>{{$test->title}}</td>
                                <?php
                                    $getUserScore = 0;
                                    $totalScore = 0;

                                    foreach($test->test_question()->get() as $question){
                                        $totalScore += $question->score;
                                        $all_totalScore += $question->score;
                                        if($question->test_answer()->where('correct', '1')->first()->user_answer()->where('user_id', auth::user()->id)->first() != null){
                                            $getUserScore += $question->score;
                                            $all_getUserScore += $question->score;
                                        }
                                    }
                                ?>
                                <td width="200px">{{$totalScore}}</td>
                                <td width="200px">{{$getUserScore}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <h3>Total Score :</h3>
            <h1 class="text-center">{{$all_getUserScore}}/{{$all_totalScore}} ({{number_format((100/$all_totalScore)*$all_getUserScore, 2)}}%)</h1>
            <h3>Dinyatakan :</h3>
            <h1 class="text-center">{!!(100/$all_totalScore)*$all_getUserScore > 80 ? '<b class="text-success">Lulus</b>':'<b class="text-danger">Tidak Lulus</b>'!!}</h1>
          </div>
      </div>
  </div>
@endsection
