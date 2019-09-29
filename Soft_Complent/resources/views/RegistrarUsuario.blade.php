@extends('Layouts.master')
@section('Titulo','Registrar usuario')
@section('Contenido')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto col-sm-12">
            <div class="card text-center">
                <div class="card-header">
                    <h1>Registrar Usuario</h1>
                </div>
            <div class="card-body">
                <form method="POST" name="Frm-RegistrarUsuario" id="Frm-RegistrarUsuario" action="">
                    @csrf
                    <div class="form-group row">
                        <label for="Txt_Nombre" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Nombres:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Nombre" name="Txt_Nombre"  maxlength="29" required>
                            @if($errors->has('Txt_Nombre'))
                            @foreach($errors->get('Txt_Nombre') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Txt_Apellido" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Apellidos:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Apellido" name="Txt_Apellido"  maxlength="29" required>
                            @if($errors->has('Txt_Apellido'))
                            @foreach($errors->get('Txt_Apellido') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Select_TipoDocumento" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Tipo de documento:
                        </label>
                        <div class="col-8">
                            <select id="Select_TipoDocumento" name="Select_TipoDocumento" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                                @foreach($TipoDocumentos as $TipoDocumento)
                                <option value="{{$TipoDocumento->idTipoDocumento}}">
                                    {{$TipoDocumento->nombreTipoDocumento}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Txt_Documento" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Número de documento:
                        </label>
                        <div class="col-8">
                            <input type="number" class="form-control" id="Txt_Documento" name="Txt_Documento"  maxlength="11" required>
                            @if($errors->has('Txt_Documento'))
                            @foreach($errors->get('Txt_Documento') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Txt_Telefono" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Teléfono:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Telefono" name="Txt_Telefono"  maxlength="29" required>
                            @if($errors->has('Txt_Telefono'))
                            @foreach($errors->get('Txt_Telefono') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Txt_Direccion" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Dirección:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_Direccion" name="Txt_Direccion"  maxlength="49" required>
                            @if($errors->has('Txt_Direccion'))
                            @foreach($errors->get('Txt_Direccion') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Select_Rol" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Rol:
                        </label>
                        <div class="col-8">
                            <select id="Select_Rol" name="Select_Rol" class="form-control" required>
                                <option value="" selected disabled hidden>Seleccione aquí</option>
                                @foreach($Roles as $Rol)
                                <option value="{{$Rol->idRol}}">
                                    {{$Rol->nombreRol}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Txt_UsuarioLogin" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Usuario del sistema:
                        </label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="Txt_UsuarioLogin" name="Txt_UsuarioLogin" placeholder="Usuario para ingresar a SoftComplent" maxlength="14" required>
                            @if($errors->has('Txt_UsuarioLogin'))
                            @foreach($errors->get('Txt_UsuarioLogin') as $error)
                            <div class="text-danger">{{$error}}</div>
                            @endforeach
                            @endif
                        </div>
				    </div>

                    <div class="form-group row">
                        <label for="Txt_Password" class="col-4 col-form-label">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Contraseña:
                        </label>
                        <div class="col-8">
                            <input type="password" class="form-control" id="Txt_Password" name="Txt_Password" placeholder="Contraseña de ingreso al sistema" maxlength="14" required>
                            @if($errors->has('Txt_Password'))
                            @foreach($errors->get('Txt_Password') as $error)
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