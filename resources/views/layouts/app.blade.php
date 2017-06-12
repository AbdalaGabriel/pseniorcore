<!doctype html>
<html lang="es">
<head>
@include('front.structure.head')
</head>

<body class="intern grid">
    <!-- MENU -->   


<div class="wrapper">
    <div class="header header-filter">
        @yield('cover-image')
        <div class="container">
            <div id="particles-js"></div>
            <div class="page-title">
                <h1>@yield('page-title')</h1>
            </div>
        </div>
    </div>

    <div class="main ">
        <div class="container large">
            @yield('content')
        </div>
    </div>
</div>




</body>
@include('front.structure.scripts')
@yield('aditionalScripts')

</html>
