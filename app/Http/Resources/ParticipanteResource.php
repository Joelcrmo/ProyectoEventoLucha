<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Participante;
use App\Http\Controllers\ParticipanteController;

class ParticipanteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ID_Participante' => $this->ID_Participante,
            'Nombre_Par' => $this->Nombre_Par,
            'Apellido_Par' => $this->Apellido_Par,
            'ID_Rol' => $this->ID_Rol,
            'ID_Tecnica' => $this->ID_Tecnica,
            'Altura_Par' => $this->Altura_Par,
            'Peso_Par' => $this->Peso_Par,
            'ID_Pais' => $this->ID_Pais,
            'ID_Categoria' => $this->ID_Categoria
        ];
    }
}
