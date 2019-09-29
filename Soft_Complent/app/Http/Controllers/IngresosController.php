<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarIngresoRequest;
use DB;

class IngresosController extends Controller
{
    public function CargarDatos(){
        $Vehiculos = array('Vehiculos' => DB::table('tipo_vehiculo')->get());

        return view('RegistrarIngreso', $Vehiculos);
    }

    public function ConsultarNivelesServicio(Request $request){
        $idVehiculo = $request->input('idVehiculo');
        $Resultados;
        $Tarifas = DB::table('tarifa AS A')
        ->select(DB::raw('A.idTarifa, B.nombreTipoVehiculo, C.nombreNivelServicio, A.valorTarifa, A.Estado'))
        ->join('tipo_vehiculo AS B', 'B.idTipoVehiculo', '=', 'A.idTipoVehiculo')
        ->join('niveles_servicio AS C', 'C.idNivelServicio', '=', 'A.idNivelServicio')
        ->where('A.idTipoVehiculo', '=', (int)$idVehiculo)->get();

        return response()->json(['Resultados' => $Tarifas]);
    }

    public function RegistrarIngreso(RegistrarIngresoRequest $request){
        $idVehiculo = $request->input('Select_Vehiculo');
        $Placa = strtoupper($request->input('Txt_placa'));
        $idTarifa = $request->input('Select_Tarifa');
        $Nombre = $request->input('Txt_Responsable');
        $Telefono = $request->input('Txt_Telefono');

        try{
            if($this::ValidarIngreso($Placa)){
                $idControl = DB::table('control_ingreso')->insertGetId(
                    ['idTarifa' => $idTarifa,
                    'responsableVehiculo' => $Nombre,
                    'telefonoResponsable' => $Telefono,
                    'usuarioEntrada' => session('idUsuario'), 
                    'Placa' => $Placa
                    ]
                );
    
                return back()->with('NotificacionExitosa', 'Se ha registrado el ingreso correcatamente con el ID de ingreso '.$idControl);

            }else{
                return back()->with('NotificacionErronea', 'No se pueden generar dos ingresos al mismo vehículo, por favor verificar el último ingreso');
            }
            

        }catch(\PDOException $e){
            return back()->with('NotificacionErronea', 'Se ha presentado el siguiente error '.$e->getMessage());
        }
    }

    public function ValidarIngreso($Placa){
        $Validacion;
        try{
            $IdIngreso = DB::table('control_ingreso')->select('idControlIngreso')
            ->where('Placa', '=', $Placa)->whereNull('fechaSalida')->get();

            foreach ($IdIngreso as $Resultado) {
                $Validacion = $Resultado->$IdIngreso;
            }
            
            if(empty($Validacion)){
                return true;
            }else{
                return false;
            }

        }catch(\Exception $e){
            return  false;
        }
    }

    public function ListarTodos(){
        $data = array('Ingresos' => $this::ListarIngresos('Todos'));
        return view('ListarIngresos', $data);
    }

    public function ListarFinalizados(){
        $data = array('Ingresos' => $this::ListarIngresos('Finalizados'));
        return view('ListarIngresos', $data);
    }

    public function ListarVigentes(){
        $data = array('Ingresos' => $this::ListarIngresos('Vigentes'));
        return view('ListarIngresos', $data);
    }

    public function ObtenerValorTotal($idControlIngreso){
        return $this::ListarIngresos('Precio', $idControlIngreso);
    }


    public function ListarIngresos($Condicion, $idOpcional = ''){

        $Ingresos = DB::table('control_ingreso AS A')
        ->select(DB::raw('A.idControlIngreso, A.Placa, C.nombreTipoVehiculo, D.nombreNivelServicio, 
        B.valorTarifa, A.fechaEntrada, E.usuarioLogin AS "usuarioEntrada", A.fechaSalida, F.usuarioLogin AS "usuarioSalida",
        A.responsableVehiculo, A.telefonoResponsable,
        @Minutos :=ROUND(IF(A.fechaSalida <> NULL, TIMESTAMPDIFF(MINUTE, A.fechaEntrada, A.fechaSalida), 
        TIMESTAMPDIFF(MINUTE, A.fechaEntrada, CURRENT_TIMESTAMP)),0) AS "minutosTranscurridos",
        (@Minutos * B.valorTarifa) AS "valorTotal", A.Estado AS "idEstado", IF(A.Estado = 1, "Vigente", "Finalizado") AS "Estado"'))
        ->join('tarifa AS B', 'B.idTarifa', '=', 'A.idTarifa')
        ->join('tipo_vehiculo AS C', 'C.idTipoVehiculo', '=', 'B.idTipoVehiculo')
        ->join('niveles_servicio AS D', 'D.idNivelServicio', '=', 'B.idNivelServicio')
        ->join('usuario AS E', 'E.idUsuario', '=', 'A.usuarioEntrada')
        ->leftJoin('usuario AS F', 'F.idUsuario', '=', 'A.usuarioSalida')
        ->where(function ($query) use ($Condicion, $idOpcional) {
            if($Condicion == 'Finalizados'){
                $query->where('A.Estado', '=', 0);
            }elseif ($Condicion == 'Vigentes') {
                $query->where('A.Estado', '=', 1);
            }elseif ($Condicion == 'Precio'){
                $query->where('A.idControlIngreso', $idOpcional);
            }
        })
        ->get();

        return $Ingresos;
    }

    public function FinalizarIngreso(Request $request){
        $idControl = $request->input('idControlIngreso');
        $Valor;
        try{
            $Costo = $this::ObtenerValorTotal($idControl);
            foreach ($Costo as $keyCosto) {
                $Valor = $keyCosto->valorTotal;
            }
            DB::table('control_ingreso')->where('idControlIngreso', (int)$idControl)
            ->update(['Estado' => 0, 'usuarioSalida' => session('idUsuario')]);
            return response()->json(['Respuesta' => 'Exito', 'Mensaje' => 'Se ha finalizado correctamente el ingreso, Valor a pagar $'.number_format($Valor).' pesos']);
        }catch(\Exception $e){
            return response()->json(['Respuesta' => 'Error', 'Mensaje' => 'Se ha presentado el siguiente error '.$e->getMessage()]);
        }

    }
}
