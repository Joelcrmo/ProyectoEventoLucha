<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Velada extends Model
{
    public $timestamps = false;
    protected $table = "Velada";

    protected $primaryKey = "ID_Velada";

    protected $fillable = [
        'ID_Velada',
        'Nombre_Vel',
        'ID_Localizacion',
        'Fecha_Vel',
    ];

    public function Localizacion()
    {
        return $this->belongsTo('App\Models\Localizacion', 'ID_Localizacion');
    }
}
