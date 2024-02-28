<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return[
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre_Usu' => $this->Nombre_Usu,
            'Password_Usu' => $this->Password_Usu,
        ];
    }
}
