<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use DB;

class LoginController extends Controller
{
    public function Login(LoginRequest $request){
        $Usuario = $request->input('Txt_usuario');
        $Password = $request->input('Txt_clave');
        $InformacionUsuario;
        $Resultados = DB::table('usuario')
        ->select(DB::raw('idUsuario, idTipoDocumento, numeroDocumento, nombreUsuario, apellidoUsuario, telefonoUsuario, direccionUsuario, idRol, usuarioLogin'))
        ->where('usuarioLogin', '=', $Usuario)
        ->where('Password', '=', $Password)
        ->where('Estado', '=', 1)->get();
        
        foreach ($Resultados as $Resultado) {
            $InformacionUsuario = $Resultado;
        }
        if(empty($InformacionUsuario)){
            return back()->with('NotificacionErronea', 'La contraseña es incorrecta, el usuario no se ha registrado o inactivo en el sistema.');
        }else{
            session(['idUsuario' => $InformacionUsuario->idUsuario]);
            session(['infoUser' => $InformacionUsuario]);
            return redirect('/ingresos/listar');
        }
    }

    public function Logout(Request $request){
        $request->session()->flush();
        return redirect('/');
      }
}
