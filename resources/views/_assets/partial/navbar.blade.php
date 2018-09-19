<?php
//Required MasterController@getWebInformations
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Title -->
        <a class="navbar-brand" href="{{ url('/') }}"> @yield('web_title') </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form role="form" method="POST" action="{{route('search', Request::is('search/user')?'user':'course')}}" class="form-inline my-2 my-lg-0 mr-auto">
                <input name="key" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" {{isset($key)?'value='.$key:''}}>
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="submit" value="&#xf002;" class="btn btn-outline-primary my-2 my-sm-0 fa">
                <!--<button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>-->
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('course/*')||Request::is('course')?'active':'' }}" href="{{route('course.index')}}">Kursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('usere/*')||Request::is('user')?'active':'' }}" href="{{route('user.index')}}">Pengguna</a>
                </li>
            </ul>
            @guest
                <ul class="navbar-nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('login')}}">Masuk</a>
                    </li>
                    <li class="nav-item navbar-dark">
                        <a class="nav-link" href="{{route('register')}}">Daftar</a>
                    </li>
                </ul>
            @else
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Rumah</a>
                        <a class="dropdown-item" href="{{route('user.show', auth::user()->id)}}"><i class="fa fa-user" aria-hidden="true"></i> Profil Saya</a>
                        <a class="dropdown-item" href="{{route('message.index')}}"><i class="fa fa-envelope" aria-hidden="true"></i> Pesan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('user.setting', [auth::user()->id, 'information'])}}"><i class="fa fa-key" aria-hidden="true"></i> User Setting</a>
                        @auth
                            @if(auth::user()->isWebAdmin() == 'admin')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('webinfo.edit')}}"><i class="fa fa-gear" aria-hidden="true"></i> Informasi Web</a>
                            @endif
                        @endauth
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>
<br>
