<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FUNDADIF</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" >

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
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
        <div class="col-md-12 col-ls-12 col-sm-12">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">sesión activa</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>

        <div style="margin-top: 100px;" class="col-md-12 col-ls-12 col-sm-12"></div>
        
        <div class="col-md-12 col-ls-12 col-sm-12">
            <div class="container">
                <div class="row">  
                    <div class="col-md-12 col-ls-12 col-sm-12">
                        <h1 class="text-center"><b>FUNDADIF</b></h1>
                    
                        <img class="img-responsive center-block" src="{{ asset('img/logo_FUNDADIF.png')}}" alt="Not found">
                    </div>
                </div>
            </div>
        </div>
        

        <!-- jQuery -->
        <script src="{{ asset('jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Scripts -->
    </body>
</html>
