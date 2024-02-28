<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <script src="{{ asset('JavaScript/editarPelea.js') }}"></script>
    <script src="{{ asset('JavaScript/FuncionesPelea.js') }}"></script>
    <title>Editar Pelea</title>
</head>
<body>
@include('header')
<h2>Editar Pelea</h2>
<div id="formularioPelea">
    <form id="formEditarPelea" action="{{ route('peleas.update', $pelea->ID_Pelea) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombrePelea">Nombre de la Pelea:</label>
        <input type="text" id="nombrePelea" name="Nombre_Pel" value="{{ $pelea->Nombre_Pel }}"><br><br>

        <label for="selectParticipanteAzul">Participante Azul:</label>
        <select id="selectParticipanteAzul" name="ID_Participante_Azul">
            @foreach($participantesAzules as $participante)
                <option value="{{ $participante->ID_Participante }}" @if($pelea->ID_Participante_Azul == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="selectParticipanteRojo">Participante Rojo:</label>
        <select id="selectParticipanteRojo" name="ID_Participante_Rojo">
            @foreach($participantesRojos as $participante)
                <option value="{{ $participante->ID_Participante }}" @if($pelea->ID_Participante_Rojo == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="selectJuez">Juez:</label>
        <select id="selectJuez" name="ID_Juez">
            @foreach($jueces as $participante)
                <option value="{{ $participante->ID_Participante }}" @if($pelea->ID_Juez == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="selectArbitro">Árbitro:</label>
        <select id="selectArbitro" name="ID_Arbitro">
            @foreach($arbitros as $participante)
                <option value="{{ $participante->ID_Participante }}" @if($pelea->ID_Arbitro == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="selectVelada">Velada:</label>
        <select id="selectVelada" name="ID_Velada">
            @foreach($veladas as $velada)
                <option value="{{ $velada->ID_Velada }}" @if($pelea->ID_Velada == $velada->ID_Velada) selected @endif>{{ $velada->Nombre_Vel }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" id="editarPeleaBtn">Editar Pelea</button>
    </form>
</div>
@include('footer')

</body>
</html>
