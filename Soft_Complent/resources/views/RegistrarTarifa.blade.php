@extends('Layouts.master')
@section('Titulo','Registrar tarifa')
@section('Contenido')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto col-sm-12">
            <div class="card text-center">
                <div class="card-header">
                    <h1>Registrar tarifa</h1>
                </div>
            <div class="card-body">
                <form method="POST" name="Frm-RegistrarTarifa" id="Frm-RegistrarTarifa" action="">
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
                        <label for="Select_NivelServicio" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Niveles de servicio:
                        </label>
                        <div class="col-8">
                            <select id="Select_NivelServicio" name="Select_NivelServicio" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                                @foreach($NivelesdeServicio as $NiveldeServicio)
                                <option value="{{$NiveldeServicio->idNivelServicio}}">
                                    {{$NiveldeServicio->nombreNivelServicio}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
					<label for="Txt_Valor" class="col-4 col-form-label">
						<i class="fa fa-id-card" aria-hidden="true"></i> Valor tarifa:
					</label>
					<div class="col-8">
						<input type="number" class="form-control" id="Txt_Valor" name="Txt_Valor" placeholder="Valor de la tarifa en pesos por minuto" maxlength="12" required>
						@if($errors->has('Txt_Valor'))
						@foreach($errors->get('Txt_Valor') as $error)
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