<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Velada;

class VeladaDBController extends Controller
{
    public function obtenerVeladas()
    {
        $veladas = DB::table('Velada')
                    ->join('Localizacion', 'Velada.ID_Localizacion', '=', 'Localizacion.ID_Localizacion')
                    ->select('Velada.*', 'Localizacion.Nombre_Loc')
                    ->get();

        return response()->json($veladas);
    }

    public function obtenerVeladaPorID($ID_Velada)
    {
        $velada = DB::select('SELECT * FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);

        return response()->json($velada);
    }

    public function crearVelada(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'Nombre_Vel' => 'required|string|min:5',
            'ID_Localizacion' => 'required|numeric',
            'Fecha_Vel' => 'required|date',
        ]);

        $nombreVel = $request->input('Nombre_Vel');
        $idLocalizacion = $request->input('ID_Localizacion');
        $fechaVel = $request->input('Fecha_Vel');

        DB::insert('INSERT INTO Velada (Nombre_Vel, ID_Localizacion, Fecha_Vel) VALUES (?, ?, ?)',
        [$nombreVel, $idLocalizacion, $fechaVel]);

        return redirect('/velada');
    }

    public function eliminarVelada($ID_Velada)
    {
        DB::delete('DELETE FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);

        return response()->json(['success' => true]);
    }

    public function actualizarVeladaEnBD($ID_Velada, $nombreVel, $idLocalizacion, $fechaVel)
    {
        // Validar los datos de entrada
        if (empty($nombreVel) || empty($idLocalizacion) || empty($fechaVel)) {
            return response()->json(['error' => 'Todos los campos son obligatorios'], 400);
        }

        if (!is_numeric($idLocalizacion)) {
            return response()->json(['error' => 'El ID de localización debe ser numérico'], 400);
        }

        if (!strtotime($fechaVel)) {
            return response()->json(['error' => 'El formato de fecha es inválido'], 400);
        }

        DB::table('Velada')
            ->where('ID_Velada', $ID_Velada)
            ->update([
                'Nombre_Vel' => $nombreVel,
                'ID_Localizacion' => $idLocalizacion,
                'Fecha_Vel' => $fechaVel
            ]);

        return response()->json(['success' => true]);
    }

    public function edit($ID_Velada)
    {
        try {
            $velada = DB::selectOne('SELECT * FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);
            if (!empty($velada)) {
                return $velada;
            } else {
                return response()->json(['error' => 'No se encontró la Velada'], 404);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Error al obtener la Velada'], 500);
        }
    }
}
