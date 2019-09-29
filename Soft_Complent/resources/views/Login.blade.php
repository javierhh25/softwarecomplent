@extends('Layouts.master')
@section('Titulo','Login')
@section('Contenido')
<div class="container">
	<div class="row">
		<div class="col-md-6 mx-auto col-sm-12">
			<div class="text-center">
            <br>
				<h1>Inicio de sesion</h1>
                <img src="{{Asset('images/Logo.png')}}" width="130" height="130" alt="">
                <br>
			</div>
			<form method="post">

				@csrf

                <br>
				<div class="form-group row">
					<label class="col-md-4 col-sm-12 col-form-label" for="Txt_usuario"><i class="fa fa-user-o" aria-hidden="true"></i> Usuario: </label>
					<div class="col-md-8 col-sm-12">
						<input class="form-control" type="text" placeholder="Usuario" name="Txt_usuario" id="Txt_usuario" />
						@if($errors->has('Txt_usuario'))
						@foreach($errors->get('Txt_usuario') as $error)
						<div class="text-danger">{{$error}}</div>
						@endforeach
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-4 col-sm-12 col-form-label" for="Txt_clave"><i class="fa fa-lock" aria-hidden="true"></i> Contraseña: </label>
					<div class="col-md-8 col-sm-12">
						<input class="form-control" type="password" name="Txt_clave" id="Txt_clave" placeholder="Contraseña" />
						@if($errors->has('Txt_clave'))
						@foreach($errors->get('Txt_clave') as $error)
						<div class="text-danger">{{$error}}</div>
						@endforeach
						@endif
					</div>
				</div>

				<input type="submit" class="btn btn-success btn-lg btn-block" value="Iniciar sesión" name="Btn_login" id="Btn_login" />

			</form>
		</div>
	</div>
</div>
@endsection
