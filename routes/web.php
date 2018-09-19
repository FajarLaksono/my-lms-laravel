<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/////------------------Admin
//adminDashboard
//stats
//user
//Course
//Lessons
//Tests

//Index and Pages
Route::group(['middleware' => ['web']],function(){
    Route::get('/', ['as' => 'index', 'uses'=>'PagesController@index']);

    //Auth
    Auth::routes();

    //Other Pages
    route::put('/search/{cat}', ['as' => 'search', 'uses' => 'PagesController@search']);

    //tutorial
    route::get('/tutorial', function(){
        return view('tutorial');
    })->name('tutorial');

    //auth
    Route::group(['middleware' => ['auth']],function(){
        //user
        Route::resource('/user', 'UserController');
        Route::get('/user/{user}/setting', ['as' => 'user.setting', 'uses' => 'UserController@setting']);
        Route::get('/user/{user}/setting/{page}', ['as' => 'user.setting', 'uses' => 'UserController@setting']);
        Route::put('/user/{user}/setting/{page}', ['as' => 'user.saveSetting', 'uses' => 'UserController@saveSetting']);
        Route::get('/home', 'HomeController@index')->name('home');

        //Course Create and Store
        Route::post('/course', ['as' => 'course.store', 'uses' => 'CourseController@store']);
        Route::get('/course/create', ['as' => 'course.create', 'uses' => 'CourseController@create']);
        route::put('/course/{course}/enroll', ['as' => 'course.setstudent', 'uses' => 'CourseController@setStudentBySlug']);

        //Message
        //route::resource('/message', 'MessageController');
        Route::post('/message', ['as' => 'message.store', 'uses' => 'MessageController@store']);
        Route::get('/message', ['as' => 'message.index', 'uses' => 'MessageController@index']);
        Route::get('/message/create', ['as' => 'message.create', 'uses' => 'MessageController@create']);
        Route::delete('/message/{message}', ['as' => 'message.destroy', 'uses' => 'MessageController@destroy']);
        Route::put('/message/{message}', ['as' => 'message.update', 'uses' => 'MessageController@update']);
        Route::get('/message/{message}/edit', ['as' => 'message.edit', 'uses' => 'MessageController@edit']);
        Route::get('/message/{message}', ['as' => 'message.show', 'uses' => 'MessageController@show']);

        Route::group(['middleware' => ['user_role']],function(){
            Route::group(['user_role'=> ['admin']],function(){
                //Lesson Create and Store
                //Route::resource('/course/{course}/lesson', 'LessonController');
                Route::get('/course/{course}/lesson/create', ['as' => 'lesson.create', 'uses' => 'LessonController@create']);
                Route::post('/course/{course}/lesson', ['as' => 'lesson.store', 'uses' => 'LessonController@store']);
                Route::get('/course/{course}/select-lesson-for-new-test', ['as' => 'test.selectLesson', 'uses' => 'TestController@selectLesson']);

                //Test Create and Store
                //Route::resource('/course/{course}/lesson/{lesson}/test', 'TestController');
                Route::get('/course/{course}/lesson/{lesson}/test/create', ['as' => 'test.create', 'uses' => 'TestController@create']);
                Route::post('/course/{course}/lesson/{lesson}/test', ['as' => 'test.store', 'uses' => 'TestController@store']);

                //question stroe and create
                //Question and Option
                //route::resource('/course/{course}/lesson/{lesson}/test/{test}/question', 'TestQuestionController');
                Route::post('/course/{course}/lesson/{lesson}/test/{test}/question', ['as' => 'question.store', 'uses' => 'TestQuestionController@store']);
                Route::get('/course/{course}/lesson/{lesson}/test/{test}/question/create', ['as' => 'question.create', 'uses' => 'TestQuestionController@create']);

                //Course Modify
                Route::put('/course/{course}', ['as' => 'course.update', 'uses' => 'CourseController@update']);
                Route::get('/course/{course}/edit', ['as' => 'course.edit', 'uses' => 'CourseController@edit']);
                Route::delete('/course/{course}', ['as' => 'course.destroy', 'uses' => 'CourseController@destroy']);
                //Lesson Modify
                Route::delete('/course/{course}/lesson/{lesson}', ['as' => 'lesson.destroy', 'uses' => 'LessonController@destroy']);
                Route::put('/course/{course}/lesson/{lesson}', ['as' => 'lesson.update', 'uses' => 'LessonController@update']);
                Route::get('/course/{course}/lesson/{lesson}/edit', ['as' => 'lesson.edit', 'uses' => 'LessonController@edit']);
                //Test
                Route::delete('/course/{course}/lesson/{lesson}/test/{test}', ['as' => 'test.destroy', 'uses' => 'TestController@destroy']);
                Route::put('/course/{course}/lesson/{lesson}/test/{test}', ['as' => 'test.update', 'uses' => 'TestController@update']);
                Route::get('/course/{course}/lesson/{lesson}/test/{test}/edit', ['as' => 'test.edit', 'uses' => 'TestController@edit']);
                //Question
                Route::delete('/course/{course}/lesson/{lesson}/test/{test}/question/{question}', ['as' => 'question.destroy', 'uses' => 'TestQuestionController@destroy']);
                Route::put('/course/{course}/lesson/{lesson}/test/{test}/question/{question}', ['as' => 'question.update', 'uses' => 'TestQuestionController@update']);
                Route::get('/course/{course}/lesson/{lesson}/test/{test}/question/{question}/edit', ['as' => 'question.edit', 'uses' => 'TestQuestionController@edit']);
            });

            Route::group(['user_role'=> ['student', 'admin']],function(){ //Student and admin area
                //Get Result
                route::get('/course/{course}/result', ['as' => 'course.result', 'uses' => 'CourseController@getCourseResult']);

                //Lesson Student area
                Route::get('/course/{course}/lesson', ['as' => 'lesson.index', 'uses' => 'LessonController@index']);
                Route::get('/course/{course}/lesson/{lesson}', ['as' => 'lesson.show', 'uses' => 'LessonController@show']);

                //Test student area
                Route::put('/course/{course}/lesson/{lesson}/test/{test}/submit', ['as' => 'test.submit', 'uses' => 'TestController@submit']);
                Route::get('/course/{course}/lesson/{lesson}/test/{test}', ['as' => 'test.show', 'uses' => 'TestController@show']);
                Route::get('/course/{course}/lesson/{lesson}/test', ['as' => 'test.index', 'uses' => 'TestController@index']);

                //question
                Route::get('/course/{course}/lesson/{lesson}/test/{test}/question/{question}', ['as' => 'question.show', 'uses' => 'TestQuestionController@show']);
                Route::get('/course/{course}/lesson/{lesson}/test/{test}/question', ['as' => 'question.index', 'uses' => 'TestQuestionController@index']);
            });
        });
        Route::group(['middleware' => ['user_web_role']],function(){
            Route::group(['user_web_role'=> ['admin']],function(){
                Route::get('/admin/set/webinformation', ['as' => 'webinfo.edit', 'uses' => 'PagesController@setWebInformation']);
                Route::put('/admin/set/webinformation', ['as' => 'webinfo.store', 'uses' => 'PagesController@storeWebInformation']);
            });
        });
        //Course Show and index
        //Route::resource('/course', 'CourseController');
    });
    Route::get('/course/{course}', ['as' => 'course.show', 'uses' => 'CourseController@show']);
    Route::get('/course', ['as' => 'course.index', 'uses' => 'CourseController@index']);
});
