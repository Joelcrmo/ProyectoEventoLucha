<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ID_Pais' => $this->ID_Pais,
            'Nombre_Pais' => $this->Nombre_Pais
        ];
    }
}
