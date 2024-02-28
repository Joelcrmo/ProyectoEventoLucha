<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tecnica extends Model
{

    protected $table = "Tecnica";

    protected $primaryKey = "ID_Tecnica";

    protected $fillable = [
        'ID_Tecnica',
        'Nombre_Tecnica',
    ];
}
