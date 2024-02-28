<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Resources\CategoriaCollection;

class CategoriaController extends Controller
{


    public function index()
    {
        $categorias = Categoria::all();
        return new CategoriaCollection($categorias);
    }


    public function show($ID_Categoria)
    {
        $categorias = Categoria::find($ID_Categoria);

        if ($categorias) {
            return $categorias;
        } else {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }
        return response()->json($categorias, 200);
    }


}
