<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "Categoria";

    protected $primaryKey = "ID_Categoria";

    protected $fillable = [
        'ID_Categoria',
        'Nombre_Cat',
    ];
}
