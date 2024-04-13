<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="JavaScript/editarVelada.js"></script>
    <title>Editar Velada</title>
</head>
@include('header')
<body>
<h2>Editar Velada</h2>

<div id="formulario-Velada">
    <form action="{{ route('velada.update', ['ID_Velada' => $velada->ID_Velada]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre-Velada">Nombre de la Velada:</label>
        <input type="text" id="nombre-Velada" name="Nombre_Vel" value="{{ $velada->Nombre_Vel }}"><br><br>

        <label for="fecha-Velada">Fecha de la Velada:</label>
        <input type="date" id="fecha-Velada" name="Fecha_Vel" value="{{ $velada->Fecha_Vel }}"><br><br>

        <label for="select-Localizacion">Localización:</label>
        <select id="select-Localizacion" name="ID_Localizacion">
            @foreach ($localizaciones as $localizacion)
                <option value="{{ $localizacion->ID_Localizacion }}"
                    {{ $localizacion->ID_Localizacion == $velada->ID_Localizacion ? 'selected' : '' }}>
                    {{ $localizacion->Nombre_Loc }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Actualizar Velada</button>
    </form>
</div>
@include('footer')
</body>
</html>
