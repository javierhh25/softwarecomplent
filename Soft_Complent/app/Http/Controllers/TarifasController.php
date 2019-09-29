<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarTarifaRequest;
use DB;

class TarifasController extends Controller
{
    public function CargarDatos(){
        $NivelesdeServicio = array('NivelesdeServicio' => DB::table('niveles_servicio')->get());
        $Vehiculos = array('Vehiculos' => DB::table('tipo_vehiculo')->get());

        return view('RegistrarTarifa', $NivelesdeServicio, $Vehiculos);
    }

    public function RegistrarTarifa(RegistrarTarifaRequest $request){
        $Vehiculo = $request->input('Select_Vehiculo');
        $NivelServicio = $request->input('Select_NivelServicio');
        $Valor = $request->input('Txt_Valor');
        $Duplicado = $this::ValidarDuplicado($Vehiculo, $NivelServicio);
        $idInsertado;

        if($Duplicado){
            try{
                $id = DB::table('tarifa')->insertGetId(
                    ['idTipoVehiculo' => $Vehiculo,
                    'idNivelServicio' => $NivelServicio,
                    'valorTarifa' => $Valor
                    ]
                );
                return back()->with('NotificacionExitosa', 'Se ha creado la tarifa correctamente');
            }catch(\Exception $e){
                return back()->with('NotificacionErronea', 'Se ha presentado el siguiente error '.$e);
            }
        }else{
            return back()->with('NotificacionErronea', 'Esta tarifa ya está creada');
        }
    }

    public function ValidarDuplicado($idVehiculo, $idNivelServicio){
        $ResultadoValidacion;
        $Validacion = DB::table('tarifa')->select('idTarifa')
        ->where('idTipoVehiculo','=', $idVehiculo)
        ->where('idNivelServicio', '=', $idNivelServicio)->get();

        foreach ($Validacion as $Validar) {
            $ResultadoValidacion = $Validar;
        }
        if(empty($ResultadoValidacion)){
            return true;
        }else{
            return false;
        }
    }

    public function ListarTarifas(){
        $Tarifas = DB::table('tarifa AS A')
        ->select(DB::raw('A.idTarifa, B.nombreTipoVehiculo, C.nombreNivelServicio, A.valorTarifa, A.Estado'))
        ->join('tipo_vehiculo AS B', 'B.idTipoVehiculo', '=', 'A.idTipoVehiculo')
        ->join('niveles_servicio AS C', 'C.idNivelServicio', '=', 'A.idNivelServicio')->get();

        $data = array('Tarifas' => $Tarifas);

        return view('ListarTarifas', $data);
    }

    public function DeshabilitarTarifa(Request $request){
        $idTarifa = $request->input('idTarifa');
        $NuevoEstado = $request->input('Estado');
        
        try{
            DB::table('tarifa')->where('idTarifa', $idTarifa)->update(['Estado' => (int)$NuevoEstado]);
            return response()->json(['Respuesta' => 'Correcto']);
        }catch(\PDOException $e){
            return response()->json(['Respuesta' => 'Error ', 'Error' => 'Error '.$e->getMessage()]);
        }
    }
}
