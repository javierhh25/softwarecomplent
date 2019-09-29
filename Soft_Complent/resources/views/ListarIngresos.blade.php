@extends('Layouts.master')
@section('Titulo','Listar ingresos')
@section('Contenido')
@section('Estilo')
<link rel="stylesheet" href="{{Asset('datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{Asset('datatables/css/responsive.bootstrap4.css')}}">
<link rel="stylesheet" href="{{Asset('css/custom.css')}}">
@endsection
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto col-sm-12">
            <div class="text-center">
                    <h1>Tarifas</h1>
            </div>
                <div class="col-md-4 mx-auto col-sm-8 right-custom">
                        <label for="Select_Filtro" class="col-md-12 col-sm-12 col-form-label">
                            <i class="fa fa-search-plus" aria-hidden="true"></i> Filtrar
                        </label>
                        <select id="Select_Filtro" name="Select_Filtro" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                                <option value="1">Vigentes</option>
                                <option value="2">Finalizados</option>
                                <option value="3">Historial completo</option>
                                
                        </select>
                </div>
                <form method="POST" name="Frm-ListarIngresos" id="Frm-ListarIngresos" action="">

                    <table id="Ingresos" class="display table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>
                                Id ingreso
                                </td>
                                <td>
                                Placa
                                </td>
                                <td>
                                Vehículo
                                </td>
                                <td>
                                Servicio
                                </td>
                                <td>
                                Valor tarifa
                                </td>
                                <td>
                                Fecha de entrada
                                </td>
                                <td>
                                Usuario de entrada
                                </td>
                                <td>
                                Fecha de salida
                                </td>
                                <td>
                                Usuario de salida
                                </td>
                                <td>
                                Responsable vehículo
                                </td>
                                <td>
                                Telefóno
                                </td>
                                <td>
                                Minutos transcurridos
                                </td>
                                <td>
                                Valor total
                                </td>
                                <td>
                                Estado 
                                </td>
                                <td>
                                Gestionar
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Ingresos as $Ingreso)
                            @csrf
                            <tr>
                                <td>
                                {{$Ingreso->idControlIngreso}}
                                </td>
                                <td>
                                {{$Ingreso->Placa}}
                                </td>
                                <td>
                                {{$Ingreso->nombreTipoVehiculo}}
                                </td>
                                <td>
                                {{$Ingreso->nombreNivelServicio}}
                                </td>
                                <td>
                                $ {{$Ingreso->valorTarifa}}
                                </td>
                                <td>
                                {{$Ingreso->fechaEntrada}}
                                </td>
                                <td>
                                {{$Ingreso->usuarioEntrada}}
                                </td>
                                <td>
                                {{$Ingreso->fechaSalida}}
                                </td>
                                <td>
                                {{$Ingreso->usuarioSalida}}
                                </td>
                                <td>
                                {{$Ingreso->responsableVehiculo}}
                                </td>
                                <td>
                                {{$Ingreso->telefonoResponsable}}
                                </td>
                                <td>
                                {{$Ingreso->minutosTranscurridos}}
                                </td>
                                <td>
                                $ {{number_format($Ingreso->valorTotal)}}
                                </td>
                                <td>
                                {{$Ingreso->Estado}} 
                                </td>
                                <td>
                                @if($Ingreso->idEstado)
                                    <button type="button" class="btn btn-outline-info" onclick="FinalizarIngreso({{$Ingreso->idControlIngreso}})" >Finalizar</button>
                                @else 
                                    <button type="button" class="btn btn-outline-dark" disabled>Finalizar</button>
                                @endif
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </form>
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
        CargarDatos('#Ingresos');

        var _token = $("input[name='_token']").val();

        $('#Select_Filtro').change(function (){
            switch (document.getElementById('Select_Filtro').value) {
                case '1':
                    window.location.href = "/ingresos/listar"
                    break;
                case '2':
                    window.location.href = "/ingresos/listarfinalizados"
                    break;
                case '3':
                    window.location.href = "/ingresos/listarhistorial"
                    break;
            
                default:
                    alert('Default')
                    break;
            }
        });

        function FinalizarIngreso(idControlIngreso){
            Swal.fire({
                title: 'Finalizar',
                text: "¿Quiere finalizar el ingreso y calcular el cobro?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/ingresos/finalizaringreso',
                        type: 'POST',
                        data: {_token:_token, idControlIngreso:idControlIngreso},
                        success: function(data){
                            if(data.Respuesta == 'Exito'){
                                swal.fire('Exito', data.Mensaje, 'success').then((result)=>{
                                    location.reload();
                                });
                            }else{
                                swal.fire('Error', data.Mensaje, 'error');
                            }
                        },
                        error: function(error){
                            console.log('Error');
                            console.log(error.responseJSON.message);
                            
                            swal.fire('Error', error.responseJSON.message, 'error');
                        }
                    });
                }
             })
        }
    </script>
    @endsection
@endsection