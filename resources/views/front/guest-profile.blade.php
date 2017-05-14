@extends('front.base')

    

    <!-- Imagen de cover -->
    @section('cover-image')
    
    @endsection



    <!-- Titulo de pagina -->
    @section('page-title')
       {{ Auth::user()->name }}
    @endsection

        <!-- External css -->
    @section('styles')
        {!!Html::style('css/user-profile.css')!!}
    @endsection

    <!-- Contenido principal -->
    @section('main')
    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

    <h1>Bienvenido! {{ Auth::user()->name }}</h1>
    <a href="#">Editar perfil</a>
    <a href="/organizer/{{ Auth::user()->id }}">Ir al organizador</a>
    <a href="http://twitter.us14.list-manage.com/unsubscribe?u=21939b15fd9aeae487bd56ef1&id=a5ecdc5c4a">Darme de baja del newsletter
    </a>

    

    @endsection

    @section('aditionalScripts')
    {!!Html::script('js/baseurl.js')!!}
    {!!Html::script('js/replacelinks.js')!!}
    @endsection
