<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Añadir Pelea</title>
</head>

<body>

@include('header')

<h2>Añadir Pelea</h2>

<div id="formulario-Pelea">
    <form action="{{ route('peleas/insertar') }}" method="POST">

        @csrf
        <label for="nombre-Pelea">Nombre de la Pelea:</label>
        <input type="text" id="nombre-Pelea" name="Nombre_Pel"><br><br>

        <label for="select-Categoria">Categoría:</label>
        <select id="select-Categoria">
            <option value="">Selecciona una categoría</option>
            <option value="1">Peso Mosca</option>
            <option value="2">Peso Gallo</option>
            <option value="3">Peso Pluma</option>
            <option value="4">Peso Ligero</option>
            <option value="5">Peso Welter</option>
            <option value="6">Peso Medio</option>
            <option value="7">Peso Semipesado</option>
            <option value="8">Peso Pesado</option>
            <option value="9">Peso Femenino</option>
            <option value="10">Peso Flyweight Femenino</option>
        </select><br><br>

        <label for="select-Participante-Azul">Participante Azul:</label>
        <select id="select-Participante-Azul" name="ID_Participante_Azul">
            @foreach ($participantesAzules as $participante)
            <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Participante-Rojo">Participante Rojo:</label>
        <select id="select-Participante-Rojo" name="ID_Participante_Rojo">
            @foreach ($participantesRojos as $participante)
            <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>


        <label for="select-Juez">Juez:</label>
        <select id="select-Juez" name="ID_Juez">
            @foreach ($jueces as $participante)
            <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Arbitro">Árbitro:</label>
        <select id="select-Arbitro" name="ID_Arbitro">
            @foreach ($arbitros as $participante)
            <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Velada">Velada:</label>
        <select id="select-Velada" name="ID_Velada">
            <option value="">Selecciona una velada</option>
        </select><br><br>

        <button type="submit" id="agregar-Pelea-Btn">Agregar Pelea</button>
    </form>
</div>

<div id="resultados-Pelea"></div>

@include('footer')

<script src="{{ asset('JavaScript/InsertarPelea.js') }}"></script>

<script>
    $(document).ready(function() {
        cargarVeladas();

        $('#selectCategoria').change(function() {
            filtrarParticipantesPorCategoria();
        });

        $('#agregarPeleaBtn').click(function() {
            $(this).prop('disabled', true);
            agregarPelea();
            window.location.href = "/peleas";
        });
    });
</script>

</body>

</html>
