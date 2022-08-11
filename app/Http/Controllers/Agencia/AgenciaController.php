<?php

namespace App\Http\Controllers\Agencia;
date_default_timezone_set('America/El_Salvador');

use App\Http\Controllers\Controller;
use App\Models\Agencia\AgenciaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgenciaController extends Controller
{
  //
  public function index()
  {
    return view('agencias.index');
  }

  public function list()
  {
    // $agencias['data'] = AgenciaModel::all();
    $agencias['data'] = DB::table('aca_agencias')->get();
    return response()->json($agencias);
  }

  public function store(Request $request)
  {
    // $agencia = new AgenciaModel();
    // $agencia->nombre_agencia = $request->nombre_agencia;
    // $agencia->direccion_agencia = $request->direccion_agencia;
    // $agencia->telefono_agencia = $request->telefono_agencia;
    // $agencia->save();

    $agencia = DB::table('aca_agencias')->insert([
      'nombre_agencia' => $request->nombre_agencia,
      'direccion_agencia' => $request->direccion_agencia,
      'telefono_agencia' => $request->telefono_agencia,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Agencia creada correctamente',
      'agencia' => $agencia
    ]);
  }

  public function show($id_agencia)
  {
    $agencia = AgenciaModel::where('id_agencia', $id_agencia)->first();
    return response()->json([
      'success' => true,
      'message' => 'Agencia encontrada',
      'agencia' => $agencia
    ]);
  }

  public function update(Request $request, $id_agencia)
  {
    $agencia = DB::table('aca_agencias')->where('id_agencia', $id_agencia)->update([
      'nombre_agencia' => $request->nombre_agencia,
      'direccion_agencia' => $request->direccion_agencia,
      'telefono_agencia' => $request->telefono_agencia,
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Agencia actualizada correctamente',
      'agencia' => $agencia
    ]);
  }

  public function destroy($id_agencia)
  {
    $agencia = DB::table('aca_agencias')->where('id_agencia', $id_agencia)->delete();

    return response()->json([
      'success' => true,
      'message' => 'Agencia eliminada correctamente',
      'agencia' => $agencia
    ]);
  }
}
