<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;
use App\Http\Resources\LocalizacionCollection;


class LocalizacionController extends Controller
{
    public function index()
    {
        $localizaciones = Localizacion::all();
        return new LocalizacionCollection($localizaciones);
    }

    public function show($ID_Localizacion)
    {
        $localizaciones = Localizacion::find($ID_Localizacion);

        if ($localizaciones) {
            return $localizaciones;
        } else {
            return response()->json(['message' => 'Localización no encontrada'], 404);
        }
        return response()->json($localizaciones, 200);
    }
}
