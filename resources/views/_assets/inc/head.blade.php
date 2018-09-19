<?php
use App\Http\Controllers\MasterController;
$web_option = MasterController::getWebInformations();
$web_title = empty($web_option['web_title']) ? config('app.name', 'LMS') : $web_option['web_title']; ?>
@section('web_title', $web_title)

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" Content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('web_title') @yield('page_title')</title>
<meta name="description" content="{{empty($web_option['web_description']) ? '' : $web_option['web_description']}}">

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
<link href="/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
