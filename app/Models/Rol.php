<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table = "Rol";

    protected $primaryKey = "ID_Rol";

    protected $fillable = [
        'ID_Rol',
        'Nombre_Rol',
    ];

}
