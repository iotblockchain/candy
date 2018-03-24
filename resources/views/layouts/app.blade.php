<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top ldbc-nav">
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
                    <a class="nav-logo" href="{{ url('/home') }}">
                        <img class="logo" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                        @else
                                    <li><a href="{{ route('home') }}">推广</a></li>
                                    <li><a href="{{ route('wallet') }}">钱包</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            注销
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="#">用户 {{ Auth::user()->name }}</a></li>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <style>
    .nav-logo {
        display: block;
        padding: 10px 15px;
    }
    .logo {
        height: 30px;
    }
    .ldbc-nav {
        background-color: transparent;
        border-color: #370096;
    }
    </style>
    @yield('inline-style')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
