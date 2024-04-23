<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Editar Pelea</title>
</head>
<body>
    @include('header')
    <h2>Editar Pelea</h2>
    <div id="formulario-Pelea">

        <form id="form-Editar-Pelea" action="{{ route('peleas.update', $pelea->ID_Pelea) }}" method="POST" onsubmit="return validarFormulario()">
            @csrf
            @method('PUT')

            <label for="nombre-Pelea">Nombre de la Pelea:</label>
            <input type="text" id="nombre-Pelea" name="Nombre_Pel" value="{{ $pelea->Nombre_Pel }}"><br><br>

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
                <option value="{{ $participante->ID_Participante }}" @if ($pelea->ID_Participante_Azul == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
                @endforeach
            </select><br><br>

            <label for="select-Participante-Rojo">Participante Rojo:</label>
            <select id="select-Participante-Rojo" name="ID_Participante_Rojo">
                @foreach ($participantesRojos as $participante)
                <option value="{{ $participante->ID_Participante }}" @if ($pelea->ID_Participante_Rojo == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
                @endforeach
            </select><br><br>

            <label for="select-Juez">Juez:</label>
            <select id="select-Juez" name="ID_Juez">
                @foreach ($jueces as $participante)
                <option value="{{ $participante->ID_Participante }}" @if ($pelea->ID_Juez == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
                @endforeach
            </select><br><br>

            <label for="select-Arbitro">Árbitro:</label>
            <select id="select-Arbitro" name="ID_Arbitro">
                @foreach ($arbitros as $participante)
                <option value="{{ $participante->ID_Participante }}" @if ($pelea->ID_Arbitro == $participante->ID_Participante) selected @endif>{{ $participante->Nombre_Par }}</option>
                @endforeach
            </select><br><br>

            <label for="select-Velada">Velada:</label>
            <select id="select-Velada" name="ID_Velada">
                @foreach ($veladas as $velada)
                <option value="{{ $velada->ID_Velada }}" @if ($pelea->ID_Velada == $velada->ID_Velada) selected @endif>{{ $velada->Nombre_Vel }}</option>
                @endforeach
            </select><br><br>
            <button type="submit" id="editar-Pelea-Btn">Editar Pelea</button>
        </form>
    </div>
    @include('footer')
    <script src="{{ asset('JavaScript/EditarPelea.js') }}"></script>
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
</body>
</html>
