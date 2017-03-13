<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!--  Metadescription -->
    <meta name="description" content="@yield('metadescription')"/>

    <!--  Page title -->
    <title>@yield('mainTitle')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'es-419'}
    </script>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!--     Favico    -->
    <link rel="apple-touch-icon" sizes="57x57" href="/icon.ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icon.ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icon.ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icon.ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="shortcut icon" href="/icon.ico/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/icon.ico/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CSS Files -->
    {!!Html::style('bootstrap-template-assets/materialKit/assets/css/bootstrap.min.css')!!}
    {!!Html::style('bootstrap-template-assets/materialKit/assets/css/material-kit.css')!!}
    {!!Html::style('css/customization.css')!!}
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="intern">

    <input type="hidden" class="hidden-title" value="@yield('hiddentitle')">
    <!-- Navbar will come here -->
    <nav class="hidden-menu">
        <div id="particles-js-2" class="absolute-pos"></div>
        <a href="#" title="Cerrar menú" class="close-hidden-menu">X</a>
        <ul>
            <li>
                {!! link_to_action('FrontController@index','Home') !!}
            </li>
            <li>
                {!! link_to_action('FrontController@portfolio','Portfolio') !!}
            </li>
            <li>
                {!! link_to_action('FrontController@blog','Noticias y novedades') !!}
            </li>
            <li>
                <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
                    Acceso clientes
                </a>
            </li>
            <li>
                {!! link_to_action('FrontController@multimediaNow','#Multimedia Now') !!}
            </li>
            <li>
                <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
                    Sobre mi
                </a>
            </li>
            <li>
                {!! link_to_action('FrontController@contact','Contacto') !!}

            </li>

        </ul>

        <span class="logo-container-menu">  
        </span> 
        
    </nav>
    <!-- end navbar -->

    <nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/">
                    <div class="logo-container">
                        
                        <div class="brand">
                            <img src="/img/front/g.svg">
                        </div>


                    </div>
                </a>
            </div>
    <div id="app">
                     

                                   <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Registro</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

     

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
