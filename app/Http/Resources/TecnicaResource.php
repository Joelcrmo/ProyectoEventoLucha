<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tecnica;
use App\Http\Controllers\TecnicaController;

class TecnicaResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'ID_Tecnica' => $this->ID_Tecnica,
            'Nombre_Tecnica' => $this->Nombre_Tecnica
        ];
    }
}
