<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\Http\Resources\ParticipanteCollection;

class ParticipanteController extends Controller
{

    public function index()
    {
        $participantes = Participante::with('Rol', 'Tecnica', 'Pais', 'Categoria')->get();
        return response()->json(['data' => $participantes]);
    }

    public function show($ID_Participante)
    {
        $participante = Participante::with('Rol', 'Tecnica', 'Pais', 'Categoria')->find($ID_Participante);

        if ($participante) {
            return $participante;
        } else {
            return response()->json(['message' => 'Participante no encontrado'], 404);
        }
    }

}
