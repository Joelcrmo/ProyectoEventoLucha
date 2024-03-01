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
}
