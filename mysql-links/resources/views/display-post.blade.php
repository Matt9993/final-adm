<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        
        <style>
            html, body {
                background: linear-gradient(to bottom right, #67b26f, #4ca2cd);
                color: #444;
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

            .content {
                text-align: center;
                color: white;
            }

            .title {
                font-size: 44px;
                height: 100%;
            }

            .nav-pills > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .nav-pills > a:hover {
                text-decoration: underline;
            }

            #side-pic {
                border-radius: 4px;
                overflow: hidden;
                box-shadow: 0 30px 80px 10px rgba(0,0,0,.2);
            }

            #prod-pic {
                margin-top: 50px;
            }

            #about-pic {
                margin-top: 50px;
            }

            .contact {
                margin-top: 50px;
                text-align: center;
            }

        </style>
    </head>
    </head>
    <body>
        <!--
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                 Collapsed Hamburger 
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                    <div class="nav-tabs">
                        <div class="nav-pills">
                            <a href="#about">About</a>
                            <a href="#posts">Posts</a>
                            <a href="#contact">Order</a>
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                            
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            @endauth
                        </div>
                    </div>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
        -->
        <div class="content">

            <div class="title m-b-md">
                <br>
                <h2 id="pname"> {{ $title }}</h2>
                <img src="{{ URL::asset($path . '/' . $indexPic) }}" width="600" height="300">
                <br>
            </div>

            <!-- END OF TITLE AND PICTURE-->
            <div id="about" class="col-sm-12 row">
                
                <div class="col-sm-6 col-sm-offset-2 col-md-8 col-md-offset-2">
                {!! $content !!}
                </div>
            </div>
            <!-- END OF ABOUT SECTION -->
        </div>
        </div><br><br>

         <!-- END OF REFERENCES SECTION -->
            
         <div class="contact" id="contact">
            <h3>Contact</h3>
            <form>
                <br><strong>Your name</strong></br>                                            <input type="text" name="cf_name"></br><strong>Your e-mail</strong></br>
                <input type="text" name="cf_email"><br><strong>Email</strong></br>                 <input type="text" name="cf_model"></br></br><strong> Message</strong></br>
                <textarea name="cf_message"></textarea>
                </br>
                </br>
                
                <a href="submit.html"><input type="button" value="Submit"></a>
                <button type="reset" value="Clear">Clear</button>
            </form></br>
        </div>



</body>
</html>