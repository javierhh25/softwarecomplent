<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarUsuarioRequest;
use DB;

class UsuariosController extends Controller
{

    public function CargarDatos(){
        $Roles = array('Roles' => DB::table('rol')->get());
        $TipoDocumentos = array('TipoDocumentos' => DB::table('tipo_documento')->get());

        return view('RegistrarUsuario', $Roles, $TipoDocumentos);
    }

    public function RegistrarUsuario(RegistrarUsuarioRequest $request){
        $Nombres = $request->input('Txt_Nombre');
        $Apellidos = $request->input('Txt_Apellido');
        $TipoDocumento = $request->input('Select_TipoDocumento');
        $NumeroDocumento = $request->input('Txt_Documento');
        $Telefono = $request->input('Txt_Telefono');
        $Direccion = $request->input('Txt_Direccion');
        $Rol = $request->input('Select_Rol');
        $Usuario = $request->input('Txt_UsuarioLogin');
        $Password = $request->input('Txt_Password');

        $Duplicado = $this::ValidarDuplicado($TipoDocumento, $NumeroDocumento, $Usuario);
        $idInsertado;

        if($Duplicado){
            try{
                $id = DB::table('usuario')->insertGetId(
                    ['idTipoDocumento' => (int)$TipoDocumento,
                    'numeroDocumento' => $NumeroDocumento,
                    'nombreUsuario' => $Nombres,
                    'apellidoUsuario' => $Apellidos,
                    'telefonoUsuario' => $Telefono,
                    'direccionUsuario' => $Direccion,
                    'idRol' => (int)$Rol,
                    'usuarioLogin' => $Usuario,
                    'Password' => $Password
                    ]
                );
                return back()->with('NotificacionExitosa', 'Se ha creado el usuario correctamente');
            }catch(\Exception $e){
                return back()->with('NotificacionErronea', 'Se ha presentado el siguiente error '.$e);
            }
        }else{
            return back()->with('NotificacionErronea', 'Verifique que no se esté repitiendo el tipo y número de documento o el usuario de ingreso al sistema');
        }
    }

    public function ValidarDuplicado($TipoDocumento, $NumeroDocumento, $Usuario){
        $ResultadoValidacion;
        $ValidacionDocumento = DB::table('usuario')->select('idUsuario')
        ->where('idTipoDocumento','=', $TipoDocumento)
        ->where('numeroDocumento', '=', $NumeroDocumento)->get();

        foreach ($ValidacionDocumento as $Validar) {
            $ResultadoValidacion = $Validar;
        }
        if(empty($ResultadoValidacion)){
            $ValidacionUsuario = DB::table('usuario')->select('idUsuario')
            ->where('usuarioLogin','=', $Usuario)->get();

            foreach ($ValidacionUsuario as $ValidarU) {
                $ResultadoValidacionU = $ValidarU;
            }

            if(empty($ResultadoValidacionU)){
                return true;
            }else{
                return false;
            }
        
        }else{
            return false;
        }
    }

    public function ListarUsuarios(){
        $Usuarios = DB::table('usuario AS A')
        ->select(DB::raw('A.idUsuario, A.idTipoDocumento, B.nombreTipoDocumento, A.numeroDocumento, A.nombreUsuario, 
        A.apellidoUsuario, A.telefonoUsuario, A.direccionUsuario, A.idRol, C.nombreRol, A.usuarioLogin, 
        A.Estado'))
        ->join('tipo_documento AS B', 'B.idTipoDocumento', '=', 'A.idTipoDocumento')
        ->join('rol AS C', 'C.idRol', '=', 'A.idRol')->get();

        $data = array('Usuarios' => $Usuarios);

        return view('ListarUsuarios', $data);
    }

    public function CambiarRol(Request $request){
        $idUsuario = $request->input('idUsuario');
        $nuevoRol = $request->input('nuevoRol');
        
        try{
            DB::table('usuario')->where('idUsuario', $idUsuario)->update(['idRol' => (int)$nuevoRol]);
            return response()->json(['Respuesta' => 'Correcto']);
        }catch(\PDOException $e){
            return response()->json(['Respuesta' => 'Error ', 'Error' => 'Error '.$e->getMessage()]);
        }
    }

    public function CambiarEstado(Request $request){
        $idUsuario = $request->input('idUsuario');
        $nuevoEstado = $request->input('nuevoEstado');
        
        try{
            DB::table('usuario')->where('idUsuario', $idUsuario)->update(['Estado' => (int)$nuevoEstado]);
            return response()->json(['Respuesta' => 'Correcto']);
        }catch(\PDOException $e){
            return response()->json(['Respuesta' => 'Error ', 'Error' => 'Error '.$e->getMessage()]);
        }
    }
}
