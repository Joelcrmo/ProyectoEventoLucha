<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnica;
use App\Http\Resources\TecnicaCollection;

class TecnicaController extends Controller
{
    public function index()
    {
        $tecnicas = Tecnica::all();
        return new TecnicaCollection($tecnicas);
    }

    public function show($ID_Tecnica)
    {
        $tecnicas = Tecnica::find($ID_Tecnica);

        if ($tecnicas) {
            return $tecnicas;
        } else {
            return response()->json(['message' => 'Tecnica no encontrada'], 404);
        }
        return response()->json($tecnicas, 200);
    }

}
