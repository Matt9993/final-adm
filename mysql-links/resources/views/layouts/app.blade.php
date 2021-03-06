<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Links') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-admin.css') }}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color: #202223">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a id="brand" class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Links') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="nav navbar-nav">
                        &nbsp;
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" id="navbar-pills">
                        <!-- Authentication Links 
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            
                        @else
                        -->
                            <div class="nav-tabs">
                                <ul class="nav nav-tabs" id="nav-tab-ul">
                                    <li><a class="active" href="{{ url('/home') }}" >
                                            Főoldal
                                        </a></li>
                                    <li><a href="{{ url('/editor') }}" >
                                        Új Hír
                                        </a></li>
                                    <li><a href="{{ url('/list-posts') }}" >
                                        Hírek
                                        </a></li>
                                    <li><a href="{{ url('/add-gallery') }}" >
                                        Új Album
                                    </a></li>
                                    <li><a href="{{ url('/galleries') }}" >
                                        Albumok
                                    </a></li>
                                    <li class="dropdown">
                                        <ul class="nav nav-tabs">
                                            <li style="text-align:right;"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                                </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </li>
                                            </ul>
                                        </ul>

                                    </li>
                                </ul>

                            </div>
                            <!--
                        @endguest
                            -->
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <div id="footer">
        @Copyright 2019
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
