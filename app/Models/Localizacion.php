<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    protected $table = "Localizacion";

    protected $primaryKey = "ID_Localizacion";

    protected $fillable = [
        'ID_Localizacion',
        'Nombre_Loc',
        'ID_Pais',
    ];

    public function Pais()
    {
        return $this->belongsTo('App\Models\Pais', 'ID_Pais');
    }
}
