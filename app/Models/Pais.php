<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{

    protected $table = "Pais";

    protected $primaryKey = "ID_Pais";

    protected $fillable = [
        'ID_Pais',
        'Nombre_Pais',
    ];
}
