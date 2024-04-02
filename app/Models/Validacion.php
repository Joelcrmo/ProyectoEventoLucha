<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{

    protected $table = "Validacion";
    public $timestamps = false;

    protected $primaryKey = "ID_Validacion";

    protected $fillable = [
        'ID_Validacion',
        'Token',
        'Fecha_Token',
        'Expiracion_Token',
        'ID_Usuario',
    ];

    public function Usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'ID_Usuario');
    }
}
