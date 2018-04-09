<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body>
    <div id="app">
        <!--barra navegacion -->
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                      <a class="navbar-brand">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                           <li><a href="{{ route('inicio') }}">Crear Transaccion</a></li>
                           <li><a href="{{ route('listarTransacciones') }}">Lista Transacciones</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                        
                        </ul>
                    </div>
                </div>
            </nav>

  <!--contenedor -->
 @yield('content')   

 </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   
</body>
</html>



