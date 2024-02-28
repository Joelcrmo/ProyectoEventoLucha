<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{

    protected $table = "Participante";

    protected $primaryKey = "ID_Participante";

    protected $fillable = [
        'ID_Participante',
        'Nombre_Par',
        'Apellido_Par',
        'ID_Rol',
        'ID_Tecnica',
        'Altura_Par',
        'Peso_Par',
        'ID_Pais',
        'ID_Categoria',
    ];

    public function Rol()
    {
        return $this->belongsTo('App\Models\Rol', 'ID_Rol');
    }

    public function Tecnica()
    {
        return $this->belongsTo('App\Models\Tecnica', 'ID_Tecnica');
    }

    public function Categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'ID_Categoria');
    }

    public function Pais()
    {
        return $this->belongsTo('App\Models\Pais', 'ID_Pais');
    }

}
