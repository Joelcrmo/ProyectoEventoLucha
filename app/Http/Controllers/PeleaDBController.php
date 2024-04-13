<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeleaDBController extends Controller
{
    public function obtenerPeleas()
    {
        // Obtener todas las Peleas con sus relaciones
        $peleas = DB::table('Pelea')
                    ->leftJoin('Velada', 'Pelea.ID_Velada', '=', 'Velada.ID_Velada')
                    ->select('Pelea.*', 'Velada.Nombre_Vel')
                    ->get();

        return response()->json($peleas);
    }

    public function obtenerPeleaPorID($ID_Pelea)
    {
        // Obtener una Pelea por su ID
        $pelea = DB::select('SELECT * FROM Pelea WHERE ID_Pelea = ?', [$ID_Pelea]);

        return response()->json($pelea);
    }

    public function crearPelea(Request $request)
    {
        // Crear una nueva Pelea en la base de datos
        $nombrePel = $request->input('Nombre_Pel');
        $idParticipanteAzul = $request->input('ID_Participante_Azul');
        $idParticipanteRojo = $request->input('ID_Participante_Rojo');
        $idJuez = $request->input('ID_Juez');
        $idArbitro = $request->input('ID_Arbitro');
        $idVelada = $request->input('ID_Velada');

        DB::insert('INSERT INTO Pelea (Nombre_Pel, ID_Participante_Azul, ID_Participante_Rojo, ID_Juez, ID_Arbitro, ID_Velada)
        VALUES (?, ?, ?, ?, ?, ?)',[$nombrePel, $idParticipanteAzul, $idParticipanteRojo, $idJuez, $idArbitro, $idVelada]);

        return redirect('/peleas');
    }

    public function eliminarPelea($ID_Pelea)
    {
        // Eliminar una Pelea de la base de datos
        DB::delete('DELETE FROM Pelea WHERE ID_Pelea = ?', [$ID_Pelea]);

        return response()->json(['success' => true]);
    }

    public function actualizarPelea(Request $request, $ID_Pelea)
    {
        // Actualizar la Pelea en la base de datos
        $nombrePel = $request->input('Nombre_Pel');
        $idParticipanteAzul = $request->input('ID_Participante_Azul');
        $idParticipanteRojo = $request->input('ID_Participante_Rojo');
        $idJuez = $request->input('ID_Juez');
        $idArbitro = $request->input('ID_Arbitro');
        $idVelada = $request->input('ID_Velada');

        DB::update('UPDATE Pelea SET Nombre_Pel = ?, ID_Participante_Azul = ?, ID_Participante_Rojo = ?, ID_Juez = ?, ID_Arbitro = ?, ID_Velada = ? WHERE ID_Pelea = ?', [$nombrePel, $idParticipanteAzul, $idParticipanteRojo, $idJuez, $idArbitro, $idVelada, $ID_Pelea]);

        // Redirigir al usuario a la página /peleas después de la actualización
        return redirect()->route('peleas')->with('success', '¡La pelea se ha actualizado correctamente!');
    }

    public function edit($ID_Pelea)
    {
        $pelea = DB::select('SELECT * FROM Pelea WHERE ID_Pelea = ?', [$ID_Pelea]);
        $pelea = !empty($pelea) ? $pelea[0] : null;

        $participantesAzules = DB::select('SELECT * FROM Participante WHERE ID_Rol = ?', [1]);
        $participantesRojos = DB::select('SELECT * FROM Participante WHERE ID_Rol = ?', [1]);
        $jueces = DB::select('SELECT * FROM Participante WHERE ID_Rol = ?', [2]);
        $arbitros = DB::select('SELECT * FROM Participante WHERE ID_Rol = ?', [3]);
        $veladas = DB::table('Velada')->get();

        return view('Pelea.editarPelea', compact('pelea', 'participantesAzules', 'participantesRojos', 'jueces', 'arbitros', 'veladas'));
    }

    public function obtenerPeleasPorVelada($ID_Velada)
    {
        // Obtener todas las peleas con sus relaciones para una velada específica
        $peleas = DB::table('Pelea')
                    ->leftJoin('Velada', 'Pelea.ID_Velada', '=', 'Velada.ID_Velada')
                    ->select('Pelea.*', 'Velada.Nombre_Vel')
                    ->where('Pelea.ID_Velada', $ID_Velada)
                    ->get();

        return response()->json($peleas);
    }


}
