<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Http\Resources\RolCollection;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return new RolCollection($roles);
    }

    public function show($ID_Rol)
    {
        $roles = Rol::find($ID_Rol);

        if ($roles) {
            return $roles;
        } else {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }
        return response()->json($roles, 200);
    }


}
