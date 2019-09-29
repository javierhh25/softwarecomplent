@extends('Layouts.master')
@section('Titulo','Listar usuarios')
@section('Contenido')
@section('Estilo')
<link rel="stylesheet" href="{{Asset('datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{Asset('datatables/css/responsive.bootstrap4.css')}}">
@endsection
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto col-sm-12">
            <div class="text-center">
                    <h1>Usuarios</h1>
            </div>
                    <table id="Usuarios" class="display table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>
                                Código usuario
                                </td>
                                <td>
                                Tipo de documento
                                </td>
                                <td>
                                Documento
                                </td>
                                <td>
                                Nombre
                                </td>
                                <td>
                                Teléfono
                                </td>
                                <td>
                                Dirección
                                </td>
                                <td>
                                Rol
                                </td>
                                <td>
                                Usuario sistema
                                </td>
                                <td>
                                Estado
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Usuarios as $Usuario)
                            @csrf
                            <tr>
                                <td>
                                {{$Usuario->idUsuario}}
                                </td>
                                <td>
                                {{$Usuario->nombreTipoDocumento}}
                                </td>
                                <td>
                                {{$Usuario->numeroDocumento}}
                                </td>
                                <td>
                                {{$Usuario->nombreUsuario}} {{$Usuario->apellidoUsuario}}
                                </td>
                                <td>
                                {{$Usuario->telefonoUsuario}}
                                </td>
                                <td>
                                {{$Usuario->direccionUsuario}}
                                </td>
                                    @if($Usuario->idRol == 1)
                                    <td >
                                        <select class="custom-select" id="Rol_{{$Usuario->idUsuario}}" name="Rol_{{$Usuario->idUsuario}}" onChange="CambiarRol({{$Usuario->idUsuario}})">
                                        <option value="1" >Administrador</option>
                                        <option value="2">Auxiliar</option>
                                        </select>
                                    </td>
                                    @else
                                    <td >
                                        <select class="custom-select" id="Rol_{{$Usuario->idUsuario}}" name="Rol_{{$Usuario->idUsuario}}" onChange="CambiarRol({{$Usuario->idUsuario}})">
                                        <option value="2">Auxiliar</option>
                                        <option value="1" >Administrador</option>
                                        </select>
                                    </td>
                                    @endif

                                <td>    
                                {{$Usuario->usuarioLogin}}
                                </td>
                                    @if($Usuario->Estado)
                                    <td >
                                        <select class="custom-select" id="Estado_{{$Usuario->idUsuario}}" name="Estado_{{$Usuario->idUsuario}}" onChange="CambiarEstado({{$Usuario->idUsuario}})">
                                        <option value="1" >Activo</option>
                                        <option value="0">Inactivo</option>
                                        </select>
                                    </td>
                                    @else
                                    <td >
                                        <select class="custom-select" id="Estado_{{$Usuario->idUsuario}}" name="Estado_{{$Usuario->idUsuario}}" onChange="CambiarEstado({{$Usuario->idUsuario}})">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                        </select>
                                    </td>
                                    @endif
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>
</div>
    @section('Scripts')
    <script type="text/javascript" src="{{Asset('datatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{Asset('datatables/js/dataTableCargar.js')}}"></script>
    <script type="text/javascript" src="{{Asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        CargarDatos('#Usuarios');

        var _token = $("input[name='_token']").val();

        function CambiarEstado(idUsuario){
            var nuevoEstado = document.getElementById("Estado_"+idUsuario).value;
            $.ajax({
                url: '/usuarios/cambiarestado',
                type: 'POST',
                data: {_token:_token, idUsuario:idUsuario, nuevoEstado:nuevoEstado},
                success: function(data){
                    if(data['Respuesta'] == 'Correcto'){
                        swal.fire('Éxito', 'Se ha actualizado el estado del usuario.', 'success');
                    }else{
                        console.log(data);
                        swal.fire('Error', 'Se ha presentado un error al intentar cambiar de estado' , 'error');
                    }
                }
            })
        }

        function CambiarRol(idUsuario){
            var nuevoRol = document.getElementById("Rol_"+idUsuario).value;
            $.ajax({
                url: '/usuarios/cambiarrol',
                type: 'POST',
                data: {_token:_token, idUsuario:idUsuario, nuevoRol:nuevoRol},
                success: function(data){
                    if(data['Respuesta'] == 'Correcto'){
                        swal.fire('Éxito', 'Se ha actualizado el rol del usuario.', 'success');
                    }else{
                        console.log(data);
                        swal.fire('Error', 'Se ha presentado un error al intentar cambiar de rol' , 'error');
                    }
                }
            })
        }

    </script>
    @endsection
@endsection