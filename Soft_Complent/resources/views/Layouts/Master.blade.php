<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Maria Angeles Muñoz Rueda">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{Asset('css/app.css')}}">
    <link rel="stylesheet" href="{{Asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{Asset('css/custom.css')}}">
    <link rel="icon" href="{{Asset('images/favicon.ico')}}" sizes="32x32">
    @yield('Estilo')
    <title>@yield('Titulo')</title>
</head>
<body>
    @include('Layouts.Header')
    @yield('Contenido')
    <script type="text/javascript" src="{{Asset('js/Jquery.js')}}"></script>
    <script type="text/javascript" src="{{Asset('js/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{Asset('js/app.js')}}"></script>
    @yield('Scripts')


    @if(!empty(session('NotificacionExitosa')))
        <script type="text/javascript">
        window.onload = function() {
            swal.fire({
            type: 'success',
            title: 'Exito',
            text: '{{session('NotificacionExitosa')}}',
            cancelButtonColor: '#dc3545',
            cancelButtonClass: 'btn btn-success',
            cancelButtonText: '<i class="fa fa-check fa-2x" aria-hidden="true"></i> Ok'
            }).then((result) => {
            if (result.value) {
            }
            });
        };
        </script>
    @endif

    @if(!empty(session('NotificacionErronea')))
    <script type="text/javascript">
        window.onload = function(){
            swal.fire({
            type: 'error',
            title: 'Error',
            html: '{!! session('NotificacionErronea') !!}',
            cancelButtonColor: '#dc3545',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText: '<i class="fa fa-times fa-2x" aria-hidden="true"></i> Cerrar'
            }).then((result) => {
            if (result.value) {
            }
            });
    };
    </script>
  @endif
</body>
</html>