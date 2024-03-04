<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Resources\UsuarioCollection;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return new UsuarioCollection($usuarios);
    }

    public function show($ID_Usuario)
    {
        $usuario = Usuario::find($ID_Usuario);

        if ($usuario) {
            return response()->json($usuario, 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

    }
}
