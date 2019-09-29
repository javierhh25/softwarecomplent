@extends('Layouts.master')
@section('Titulo','Registrar ingreso')
@section('Contenido')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto col-sm-12">
            <div class="card text-center">
                <div class="card-header">
                    <h1>Registrar Ingreso</h1>
                </div>
            <div class="card-body">
                <form method="POST" name="Frm-RegistrarIngreso" id="Frm-RegistrarIngreso" action="">
                    @csrf
                    <div class="form-group row">
                        <label for="Select_Vehiculo" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Tipo de vehículo:
                        </label>
                        <div class="col-8">
                            <select id="Select_Vehiculo" name="Select_Vehiculo" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                                @foreach($Vehiculos as $Vehiculo)
                                <option value="{{$Vehiculo->idTipoVehiculo}}">
                                    {{$Vehiculo->nombreTipoVehiculo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Txt_placa" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Placa:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_placa" name="Txt_placa" placeholder="Placa del vehículo" maxlength="6" required>
                            @if($errors->has('Txt_placa'))
                            @foreach($errors->get('Txt_placa') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Select_Tarifa" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Seleccionar tarifa:
                        </label>
                        <div class="col-8">
                            <select id="Select_Tarifa" name="Select_Tarifa" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Txt_Responsable" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Nombre:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Responsable" name="Txt_Responsable" placeholder="Nombre del responsable del vehículo" maxlength="30" required>
                            @if($errors->has('Txt_Responsable'))
                            @foreach($errors->get('Txt_Responsable') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Txt_Telefono" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Telefono:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Telefono" name="Txt_Telefono" placeholder="Telefono del responsable del vehículo" maxlength="30" required>
                            @if($errors->has('Txt_Telefono'))
                            @foreach($errors->get('Txt_Telefono') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-lg btn-block" value="Registrar" name="Btn_registrar" id="Btn_registrar">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('Scripts')
<script src="{{Asset('js/custom.js')}}"></script>
<script type="text/javascript">
    $('#Select_Vehiculo').change(function(){
        var _token = $("input[name='_token']").val();
        var idVehiculo = document.getElementById('Select_Vehiculo').value;
        $.ajax({
            url: '/ingresos/consultarniveles',
            type: 'POST',
            data: {_token:_token, idVehiculo:idVehiculo},
            success: function(data){
                LlenarSelectGlobal('Select_Tarifa', data.Resultados, 'idTarifa', 'nombreNivelServicio');
            }
        });
        
    });

    $('#Frm-RegistrarIngreso').submit(function(e){
        var ValidarPlaca;
        var Placa = document.getElementById('Txt_placa').value;
        var Vehiculo = document.getElementById('Select_Vehiculo').value;
        if(Vehiculo == 1){
            ValidarPlaca = /^(([a-zA-Z]{1,3})+([0-9]{1,2})+([/^a-zA-Z]{1,1}))+$/i.test(Placa);
        }else{
            ValidarPlaca = /^(([a-zA-Z]{1,3})+([0-9]{1,3}))+$/i.test(Placa);
        }
        if(!ValidarPlaca){
            e.preventDefault();
            swal.fire('Error', 'El formato de la placa no es válido', 'error');
        }
	});
</script>
@endsection