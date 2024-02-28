<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Rol;
use App\Http\Controllers\RolController;

class RolResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'ID_Rol' => $this->ID_Rol,
            'Nombre_Rol' => $this->Nombre_Rol
        ];
    }
}
