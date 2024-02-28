<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalizacionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'ID_Localizacion' => $this->ID_Localizacion,
          'Nombre_Loc' => $this->Nombre_Loc,
          'ID_Pais' => $this->ID_Pais,
        ];
    }
}
