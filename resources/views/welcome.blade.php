<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            html, body {
                background-color: #fff;
                color: #333;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            body {
                /* background: linear-gradient(to left bottom, #ffbf8d 1%, #fca792 5%, #ec798b, #9441a1, #7630c9 90%),
                            linear-gradient(127deg, #9441a1, #ec798b);
                background: linear-gradient(127deg, #7630c9, #9441a1);
                background: linear-gradient(127deg, #9441a1, #ec798b); */
                background: linear-gradient(50deg, #5400E6, #C200E4);
                background: linear-gradient(40deg, #947fee,#fa74b1);
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 0;
                top: 0;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                display: block;
                color: rgba(255,255,255,0.8);
                padding: 20px 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">登录</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">LDBC<br>Candy</div>
            </div>
        </div>
    </body>
</html>
