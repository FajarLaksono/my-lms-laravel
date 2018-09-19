@extends('_assets.layout.single')
@section('page_title', ' - Welcome')

@section('content')
    <div class="container">
        <div class="alert alert-danger">{{$alert}}</div>
        <a href="{{$url}}" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
    </div>
@endsection
