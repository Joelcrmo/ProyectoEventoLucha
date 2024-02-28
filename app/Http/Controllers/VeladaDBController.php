<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Velada;
use App\Models\Localizacion;
use App\Http\Controllers\DatabaseController;

class VeladaDBController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function obtenerVeladas()
    {
        $this->databaseController->connect();

        $veladas = Velada::join('Localizacion', 'Velada.ID_Localizacion', '=', 'Localizacion.ID_Localizacion')
                    ->select('Velada.*', 'Localizacion.Nombre_Loc')
                    ->get();

        return response()->json($veladas);
    }

    public function obtenerVeladaPorID($ID_Velada)
    {
        $this->databaseController->connect();

        $velada = Velada::where('ID_Velada', $ID_Velada)->get();

        return response()->json($velada);
    }

    public function crearVelada(Request $request)
    {
        $this->databaseController->connect();

        $nombreVel = $request->input('Nombre_Vel');
        $idLocalizacion = $request->input('ID_Localizacion');
        $fechaVel = $request->input('Fecha_Vel');

        $velada = new Velada();
        $velada->Nombre_Vel = $nombreVel;
        $velada->ID_Localizacion = $idLocalizacion;
        $velada->Fecha_Vel = $fechaVel;
        $velada->save();

        return redirect('/velada');
    }

    public function eliminarVelada($ID_Velada)
    {
        $this->databaseController->connect();

        $velada = Velada::where('ID_Velada', $ID_Velada)->delete();

        return response()->json(['success' => true]);
    }

    public function actualizarVeladaEnBD($ID_Velada, $nombreVel, $idLocalizacion, $fechaVel)
    {
        $this->databaseController->connect();

        $velada = Velada::where('ID_Velada', $ID_Velada)
                        ->update([
                            'Nombre_Vel' => $nombreVel,
                            'ID_Localizacion' => $idLocalizacion,
                            'Fecha_Vel' => $fechaVel
                        ]);

        return true;
    }

    public function edit($ID_Velada)
    {
        try {
            $this->databaseController->connect();

            $velada = Velada::where('ID_Velada', $ID_Velada)->first();
            if (!empty($velada)) {
                return $velada;
            } else {
                return response()->json(['error' => 'No se encontró la Velada'], 404);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Error al obtener la Velada'], 500);
        }
    }
}













// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; // Importar la clase DB
// use App\Models\Velada;

// class VeladaDBController extends Controller
// {
//     public function obtenerVeladas()
//     {
//         $veladas = DB::table('Velada')
//                     ->join('Localizacion', 'Velada.ID_Localizacion', '=', 'Localizacion.ID_Localizacion')
//                     ->select('Velada.*', 'Localizacion.Nombre_Loc')
//                     ->get();

//         return response()->json($veladas);
//     }

//     public function obtenerVeladaPorID($ID_Velada)
//     {
//         $velada = DB::select('SELECT * FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);

//         return response()->json($velada);
//     }

//     public function crearVelada(Request $request)
//     {
//         $nombreVel = $request->input('Nombre_Vel');
//         $idLocalizacion = $request->input('ID_Localizacion');
//         $fechaVel = $request->input('Fecha_Vel');

//         DB::insert('INSERT INTO Velada (Nombre_Vel, ID_Localizacion, Fecha_Vel) VALUES (?, ?, ?)', [$nombreVel, $idLocalizacion, $fechaVel]);

//         return redirect('/velada');
//     }

//     public function eliminarVelada($ID_Velada)
//     {
//         DB::delete('DELETE FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);

//         return response()->json(['success' => true]);
//     }


//     public function actualizarVeladaEnBD($ID_Velada, $nombreVel, $idLocalizacion, $fechaVel)
// {
//     DB::table('Velada')
//         ->where('ID_Velada', $ID_Velada)
//         ->update([
//             'Nombre_Vel' => $nombreVel,
//             'ID_Localizacion' => $idLocalizacion,
//             'Fecha_Vel' => $fechaVel
//         ]);

//     return true;
// }

// public function edit($ID_Velada)
// {
//     try {

//         $velada = DB::selectOne('SELECT * FROM Velada WHERE ID_Velada = ?', [$ID_Velada]);
//         if (!empty($velada)) {
//             return $velada;
//         } else {
//             return response()->json(['error' => 'No se encontró la Velada'], 404);
//         }
//     } catch (\Exception $exception) {
//         return response()->json(['error' => 'Error al obtener la Velada'], 500);
//     }
// }


// }



