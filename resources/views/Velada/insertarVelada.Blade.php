<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Añadir Velada</title>
    <script src="{{ asset('JavaScript/insertarVelada.js') }}"></script>
</head>
@include('header')
<body>
<h2>Añadir Velada</h2>

<div id="formulario-Velada">
    <form action="{{ route('velada/insertar') }}" method="POST" class="metodo-post" onsubmit="return validarFormulario()">
        @csrf
        <label for="nombre-Velada">Nombre de la Velada:</label>
        <input type="text" id="nombre-Velada" name="Nombre_Vel" required><br><br>

        <label for="fecha-Velada">Fecha de la Velada:</label>
        <input type="date" id="fecha-Velada" name="Fecha_Vel" required><br><br>

        <label for="select-Localizacion">Localización:</label>
        <select id="select-Localizacion" name="ID_Localizacion" required>
            @foreach ($localizaciones as $localizacion)
                <option value="{{ $localizacion->ID_Localizacion }}">{{ $localizacion->Nombre_Loc }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" id="agregar-Velada-Btn">Agregar Velada</button>
    </form>
</div>

<div id="resultadosVelada"></div>

@include('footer')

<script>
function validarFormulario() {
    var nombreVelada = document.getElementById("nombre-Velada").value;
    var fechaVelada = document.getElementById("fecha-Velada").value;

    // Expresión regular para permitir letras, números y espacios en el nombre
    var nombreRegex = /^[a-zA-Z0-9\s]+$/;

    if (nombreVelada === "" || fechaVelada === "") {
        alert("Por favor, complete todos los campos requeridos.");
        return false;
    }

    // Verificar si el nombre contiene caracteres no permitidos
    if (!nombreRegex.test(nombreVelada)) {
        alert("Por favor, ingrese un nombre válido sin caracteres especiales.");
        return false;
    }

    // Verificar si el nombre tiene al menos 5 caracteres
    if (nombreVelada.length < 5) {
        alert("El nombre de la velada debe tener al menos 5 caracteres.");
        return false;
    }

    return true;
}

</script>

</body>
</html>
