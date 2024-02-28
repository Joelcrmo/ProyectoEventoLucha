<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'ID_Categoria' => $this->ID_Categoria,
          'Nombre_Cat' => $this->Nombre_Cat
        ];

    }
}
