<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Http\Resources\PaisCollection;


class PaisController extends Controller
{

    public function index()
    {
        $paises = Pais::all();
        return new PaisCollection($paises);
    }

    public function show($ID_Pais)
    {
        $paises = Pais::find($ID_Pais);

        if ($paises) {
            return $paises;
        } else {
            return response()->json(['message' => 'Pais no encontrado'], 404);
        }
        return response()->json($paises, 200);
    }

}
