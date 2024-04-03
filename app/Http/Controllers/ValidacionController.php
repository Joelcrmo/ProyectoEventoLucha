<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validacion;
use App\Models\Usuario;
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

    public function create($ID_Usuario)
    {
        $token = bin2hex(random_bytes(28));
        $fecha_create = now();
        $fecha_expire = now()->addDays(2);

        $validacion = new Validacion();
        $validacion->Token = $token;
        $validacion->Fecha_Token = $fecha_create;
        $validacion->Expiracion_Token = $fecha_expire;
        $validacion->ID_Usuario = $ID_Usuario;

        if ($validacion->save()) {
            return response()->json(['message' => 'Validación creada correctamente', 'token' => $token], 201);
        } else {
            return response()->json(['message' => 'Error al crear la validación'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Usuario' => 'required',
        ]);

        return $this->create($request->ID_Usuario);
    }
}
