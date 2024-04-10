<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Participante;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function show($ID_Categoria)
    {
        $categoria = Categoria::find($ID_Categoria);

        if ($categoria) {
            return response()->json($categoria);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }

    public function participantesPorCategoria($ID_Categoria)
    {
        $participantes = Participante::where('ID_Categoria', $ID_Categoria)->get();

        if ($participantes->isNotEmpty()) {
            return response()->json($participantes);
        } else {
            return response()->json(['message' => 'No se encontraron participantes para esta categoría'], 404);
        }
    }
}

