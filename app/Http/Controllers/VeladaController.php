<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Velada;
use App\Models\Localizacion;
use App\Http\Resources\VeladaCollection;
use App\Http\Controllers\VeladaDBController; // Asegúrate de importar el controlador

class VeladaController extends Controller
{
    protected $veladaDBController;

    public function __construct(VeladaDBController $veladaDBController)
    {
        $this->veladaDBController = $veladaDBController;
    }

    public function index()
    {
        // Llamada a obtenerVeladas() del VeladaDBController
        return $this->veladaDBController->obtenerVeladas();
    }

    public function show($ID_Velada)
    {
        // Llamada a obtenerVeladaPorID($ID_Velada) del VeladaDBController
        return $this->veladaDBController->obtenerVeladaPorID($ID_Velada);
    }

    public function store(Request $request)
    {
        // Validación y luego llamada a crearVelada(Request $request) del VeladaDBController
        $request->validate([
            'Nombre_Vel' => 'required',
            'ID_Localizacion' => 'required',
            'Fecha_Vel' => 'required',
        ]);

        return $this->veladaDBController->crearVelada($request);
    }

    public function create()
    {
        // Obtener todas las localizaciones
        $localizaciones = Localizacion::all();

        // Verificar si se encontraron localizaciones
        if ($localizaciones->isEmpty()) {
            // Manejar el caso en que no se encontraron localizaciones
            return response()->json(['error' => 'No se encontraron localizaciones'], 404);
        }

        // Si se encontraron localizaciones, cargar la vista con las localizaciones disponibles
        return view('Velada.insertarVelada', compact('localizaciones'));
    }


    public function destroy($ID_Velada)
    {
        // Llamada a eliminarVelada($ID_Velada) del VeladaDBController
        return $this->veladaDBController->eliminarVelada($ID_Velada);
    }

    public function update(Request $request, $ID_Velada)
    {
        // Validar la solicitud
        $request->validate([
            'Nombre_Vel' => 'required',
            'ID_Localizacion' => 'required',
            'Fecha_Vel' => 'required',
        ]);

        // Obtener datos de la solicitud
        $nombreVel = $request->input('Nombre_Vel');
        $idLocalizacion = $request->input('ID_Localizacion');
        $fechaVel = $request->input('Fecha_Vel');

        // Llamada a la función para actualizar la Velada en la base de datos
        $actualizacionExitosa = $this->veladaDBController->actualizarVeladaEnBD($ID_Velada, $nombreVel, $idLocalizacion, $fechaVel);

        if ($actualizacionExitosa) {
            return redirect('/velada')->with('success', 'Velada actualizada exitosamente');
        } else {
            return redirect('/velada')->with('error', 'Error al actualizar la Velada');
        }
    }

    public function edit($ID_Velada)
    {
        // Obtener todas las localizaciones
        $localizaciones = Localizacion::all();

        // Verificar si se encontraron localizaciones
        if ($localizaciones->isEmpty()) {
            // Manejar el caso en que no se encontraron localizaciones
            return response()->json(['error' => 'No se encontraron localizaciones'], 404);
        }

        // Llamada al método edit del VeladaDBController
        $velada = $this->veladaDBController->edit($ID_Velada);

        // Verificar si se encontró la velada
        if (!$velada) {
            // Manejar el caso en que no se encontró la velada
            return response()->json(['error' => 'No se encontró la velada'], 404);
        }

        // Pasar las localizaciones y la velada a la vista
        return view('Velada.editarVelada', compact('velada', 'localizaciones'));
    }




}
