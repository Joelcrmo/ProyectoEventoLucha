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
    <form action="{{ route('peleas/insertar') }}" method="POST" onsubmit="return validarFormulario()">
        @csrf
        <label for="nombre-Pelea">Nombre de la Pelea:</label>
        <input type="text" id="nombre-Pelea" name="Nombre_Pel" required><br><br>

        <label for="select-Categoria">Categoría:</label>
        <select id="select-Categoria" required>
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
        <select id="select-Participante-Azul" name="ID_Participante_Azul" required>
            @foreach ($participantesAzules as $participante)
                <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Participante-Rojo">Participante Rojo:</label>
        <select id="select-Participante-Rojo" name="ID_Participante_Rojo" required>
            @foreach ($participantesRojos as $participante)
                <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Juez">Juez:</label>
        <select id="select-Juez" name="ID_Juez" required>
            @foreach ($jueces as $participante)
                <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Arbitro">Árbitro:</label>
        <select id="select-Arbitro" name="ID_Arbitro" required>
            @foreach ($arbitros as $participante)
                <option value="{{ $participante->ID_Participante }}">{{ $participante->Nombre_Par }}</option>
            @endforeach
        </select><br><br>

        <label for="select-Velada">Velada:</label>
        <select id="select-Velada" name="ID_Velada" required>
            <option value="">Selecciona una velada</option>
        </select><br><br>

        <button type="button" id="agregar-Pelea-Btn">Agregar Pelea</button>
    </form>
</div>

<div id="resultados-Pelea"></div>

@include('footer')

<script src="{{ asset('JavaScript/InsertarPelea.js') }}"></script>
<script>
    function validarFormulario() {
        var nombrePelea = document.getElementById("nombre-Pelea").value;
        var categoria = document.getElementById("select-Categoria").value;
        var velada = document.getElementById("select-Velada").value;
        var participanteAzul = document.getElementById("select-Participante-Azul").value;
        var participanteRojo = document.getElementById("select-Participante-Rojo").value;

        // Expresión regular para permitir letras, números y espacios en el nombre
        var nombreRegex = /^[a-zA-Z0-9\s]+$/;


        if (nombrePelea === "" || categoria === "" || velada === "" || participanteAzul === "" || participanteRojo === "") {
            alert("Por favor, completa todos los campos requeridos.");
            return false;
        }

        // Verificar si el nombre de la pelea contiene caracteres no permitidos
        if (!nombreRegex.test(nombrePelea)) {
            alert("Por favor, ingresa un nombre de pelea válido sin caracteres especiales.");
            return false;
        }

        // Verificar si el nombre tiene al menos 5 caracteres
        if (nombrePelea.length < 5) {
            alert("El nombre de la pelea debe tener al menos 5 caracteres.");
            return false;
        }

        // Verificar si el participante azul es igual al participante rojo
        if (participanteAzul === participanteRojo) {
            alert("El participante azul y rojo deben ser diferentes.");
            return false;
        }

        return true;
    }

</script>

<script>
$(document).ready(function() {
    cargarVeladas();

    $('#select-Categoria').change(function() {
        filtrarParticipantesPorCategoria();
    });

    $('#agregar-Pelea-Btn').click(function() {
        if (validarFormulario()) {
            $(this).prop('disabled', true);
            agregarPelea();
            console.log("Pelea agregada correctamente.");
            window.location.href = "/peleas";
        }
    });
});
</script>

</body>

</html>
