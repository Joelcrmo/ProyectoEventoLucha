<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValidacionResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'ID_Validacion' => $this->ID_Validacion,
            'Token' => $this->Token,
            'Fecha_Token' => $this->Fecha_Token,
            'Expiracion_Token' => $this->Expiracion_Token,
            'ID_Usuario' => $this->ID_Usuario,
        ];
    }
}
