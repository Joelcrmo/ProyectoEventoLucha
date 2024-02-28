<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelea extends Model
{
    public $timestamps = false;
    protected $table = "Pelea";

    protected $primaryKey = "ID_Pelea";

    protected $fillable =[
        'ID_Pelea',
        'Nombre_Pel',
        'ID_Participante_Azul',
        'ID_Participante_Rojo',
        'ID_Juez',
        'ID_Arbitro',
        'ID_Velada',
    ];

    public function Velada()
    {
        return $this->belongsTo('App\Models\Velada', 'ID_Velada');
    }

    public function Arbitro()
    {
        return $this->belongsTo('App\Models\Participante', 'ID_Participante');
    }

    public function Juez()
    {
        return $this->belongsTo('App\Models\Participante', 'ID_Participante');
    }

    public function Participante_Azul()
    {
        return $this->belongsTo('App\Models\Participante', 'ID_Participante');
    }

    public function Participante_Rojo()
    {
        return $this->belongsTo('App\Models\Participante', 'ID_Participante');
    }
}
