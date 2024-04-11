<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pelea;
use App\Models\Participante;
use App\Models\Velada;
use App\Http\Resources\PeleaCollection;
use App\Http\Controllers\PeleaDBController;

class PeleaController extends Controller
{
    protected $peleaDBController;

    public function __construct(PeleaDBController $peleaDBController)
    {
        $this->peleaDBController = $peleaDBController;
    }

    public function index()
    {
        return $this->peleaDBController->obtenerPeleas();
    }

    public function show($ID_Pelea)
    {
        return $this->peleaDBController->obtenerPeleaPorID($ID_Pelea);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Pel' => 'required',
            'ID_Participante_Azul' => 'required',
            'ID_Participante_Rojo' => 'required',
            'ID_Juez' => 'required',
            'ID_Arbitro' => 'required',
            'ID_Velada' => 'required',
        ]);

        return $this->peleaDBController->crearPelea($request);
    }

    public function create()
    {
        $participantesAzules = Participante::where('ID_Rol', '1')->get();
        $participantesRojos = Participante::where('ID_Rol', '1')->get();
        $jueces = Participante::where('ID_Rol', '2')->get();
        $arbitros = Participante::where('ID_Rol', '3')->get();
        $veladas = Velada::all();

        return view('Pelea.insertarPelea', compact('participantesAzules', 'participantesRojos', 'jueces', 'arbitros', 'veladas'));
    }

    public function destroy($ID_Pelea)
    {
        return $this->peleaDBController->eliminarPelea($ID_Pelea);
    }

    public function update(Request $request, $ID_Pelea)
    {
        $request->validate([
            'Nombre_Pel' => 'required',
            'ID_Participante_Azul' => 'required',
            'ID_Participante_Rojo' => 'required',
            'ID_Juez' => 'required',
            'ID_Arbitro' => 'required',
            'ID_Velada' => 'required',
        ]);

        // Llama al método actualizarPelea del PeleaDBController
        return $this->peleaDBController->actualizarPelea($request, $ID_Pelea);
    }


    public function edit($ID_Pelea)
    {
        return $this->peleaDBController->edit($ID_Pelea);
    }

}
