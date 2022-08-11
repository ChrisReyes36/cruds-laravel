<?php

namespace App\Http\Controllers\Departamento;
date_default_timezone_set('America/El_Salvador');

use App\Http\Controllers\Controller;
use App\Models\Departamento\Departamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public function index()
    {
        return view('departamentos.index');
    }

    public function list()
    {
        $departamentos['data'] = DB::table('aca_departamentos')->get();
        return response()->json($departamentos);
    }

    public function store(Request $request)
    {
        $departamento = DB::table('aca_departamentos')->insert([
            'nombre_departamento' => $request->nombre_departamento,
            'descripcion_departamento' => $request->descripcion_departamento,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Departamento creado correctamente',
            'departamento' => $departamento
        ]);
    }

    public function show($id_departamento)
    {
        $departamento = Departamento::where('id_departamento', $id_departamento)->first();
        return response()->json([
            'success' => true,
            'message' => 'Departamento encontrado',
            'departamento' => $departamento
        ]);
    }

    public function update(Request $request, $id_departamento)
    {
        $departamento = DB::table('aca_departamentos')->where('id_departamento', $id_departamento)->update([
            'nombre_departamento' => $request->nombre_departamento,
            'descripcion_departamento' => $request->descripcion_departamento,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Departamento actualizado correctamente',
            'departamento' => $departamento
        ]);
    }

    public function destroy($id_departamento)
    {
        $departamento = DB::table('aca_departamentos')->where('id_departamento', $id_departamento)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Departamento eliminado correctamente',
            'departamento' => $departamento
        ]);
    }
}
