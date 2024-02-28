<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validacion;
use App\Http\Resources\ValidacionCollection;

class ValidacionController extends Controller
{
    public function index()
    {
        $validaciones = Validacion::all();
        return new ValidacionCollection($validaciones);
    }

    public function show($ID_Validacion)
    {
        $validacion = Validacion::find($ID_Validacion);

        if ($validacion) {
            return response()->json($validacion, 200);
        } else {
            return response()->json(['message' => 'Validación no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'Token' => 'required|string',
            'Fecha_Token' => 'required|date',
            'Expiracion_Token' => 'required|date',
            'ID_Usuario' => 'required|integer',
        ]);

        try {
            $validacion = Validacion::create([
                'Token' => $request->Token,
                'Fecha_Token' => $request->Fecha_Token,
                'Expiracion_Token' => $request->Expiracion_Token,
                'ID_Usuario' => $request->ID_Usuario,
            ]);

            return response()->json($validacion, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar la validación: ' . $e->getMessage()], 500);
        }
    }
}
