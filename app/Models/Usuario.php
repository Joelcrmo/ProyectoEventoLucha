<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = "Usuario";

    protected $primaryKey = "ID_Usuario";

    protected $fillable = [
        'ID_Usuario',
        'Nombre_Usu',
        'Password_Usu',
    ];
}
