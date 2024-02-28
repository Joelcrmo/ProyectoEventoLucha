<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeleaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ID_Pelea' => $this->ID_Pelea,
            'Nombre_Pel' => $this->Nombre_Pel,
            'ID_Participante_Azul' => $this->ID_Participante_Azul,
            'ID_Participante_Rojo' => $this->ID_Participante_Rojo,
            'ID_Juez' => $this->ID_Juez,
            'ID_Arbitro' => $this->ID_Arbitro,
            'ID_Velada' => $this->ID_Velada
        ];
    }
}

