@extends('Layouts.master')
@section('Titulo','Listar tarifas')
@section('Contenido')
@section('Estilo')
<link rel="stylesheet" href="{{Asset('datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{Asset('datatables/css/responsive.bootstrap4.css')}}">
@endsection
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto col-sm-10">
            <div class="text-center">
                    <h1>Tarifas</h1>
            </div>
                    <table id="Tarifas" class="display table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>
                                Codigo tarifa
                                </td>
                                <td>
                                Tipo de vehículo
                                </td>
                                <td>
                                Nivel de servicio
                                </td>
                                <td>
                                Valor tarifa
                                </td>
                                <td>
                                Estado
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Tarifas as $Tarifa)
                            @csrf
                            <tr>
                                <td>
                                {{$Tarifa->idTarifa}}
                                </td>
                                <td>
                                {{$Tarifa->nombreTipoVehiculo}}
                                </td>
                                <td>
                                {{$Tarifa->nombreNivelServicio}}
                                </td>
                                <td>
                                $ {{$Tarifa->valorTarifa}}
                                </td>
                                @if($Tarifa->Estado)
                                <td >
                                    <select class="custom-select" id="Estado_{{$Tarifa->idTarifa}}" name="Estado_{{$Tarifa->idTarifa}}" onChange="CambiarEstado({{$Tarifa->idTarifa}})">
                                    <option value="1" >Activo</option>
                                    <option value="0">Inactivo</option>
                                    </select>
                                </td>
                                @else
                                <td >
                                    <select class="custom-select" id="Estado_{{$Tarifa->idTarifa}}" name="Estado_{{$Tarifa->idTarifa}}" onChange="CambiarEstado({{$Tarifa->idTarifa}})">
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
        CargarDatos('#Tarifas');

        function CambiarEstado(idTarifa){
            var _token = $("input[name='_token']").val();
            var Estado = document.getElementById("Estado_"+idTarifa).value;
            $.ajax({
                url: '/tarifas/cambiarestado',
                type: 'POST',
                data: {_token:_token, idTarifa:idTarifa, Estado:Estado},
                success: function(data){
                    if(data['Respuesta'] == 'Correcto'){
                        swal.fire('Éxito', 'Se ha actualizado el estado de la tarifa.', 'success');
                    }else{
                        console.log(data);
                        swal.fire('Error', 'Se ha presentado un error al intentar cambiar de estado' , 'error');
                    }
                }
            })
        }

    </script>
    @endsection
@endsection
