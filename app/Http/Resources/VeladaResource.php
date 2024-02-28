<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Velada;
use App\Http\Controllers\VeladaController;


class VeladaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ID_Velada' => $this->ID_Velada,
            'Nombre_Vel' => $this->Nombre_Vel,
            'ID_Localizacion' => $this->ID_Localizacion,
            'Fecha_Vel' => $this->Fecha_Vel
        ];
    }
}

