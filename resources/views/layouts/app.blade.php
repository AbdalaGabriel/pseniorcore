<!doctype html>
<html lang="es">
<head>
@include('front.structure.head')
</head>

<body class="intern form-reg">
    <!-- MENU -->   


<div class="wrapper-forms">
<div id="particles-js"></div>
    <div class="header header-filter">
      
        <div class="container">
           
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
