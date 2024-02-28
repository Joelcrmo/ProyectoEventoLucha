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

<div id="formularioVelada">
    <form action="{{ route('velada/insertar') }}" method="POST">
        @csrf
        <label for="nombreVelada">Nombre de la Velada:</label>
        <input type="text" id="nombreVelada" name="Nombre_Vel"><br><br>

        <label for="fechaVelada">Fecha de la Velada:</label>
        <input type="date" id="fechaVelada" name="Fecha_Vel"><br><br>

        <label for="selectLocalizacion">Localización:</label>
        <select id="selectLocalizacion" name="ID_Localizacion">
            @foreach($localizaciones as $localizacion)
                <option value="{{ $localizacion->ID_Localizacion }}">{{ $localizacion->Nombre_Loc }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" id="agregarVeladaBtn">Agregar Velada</button>
    </form>
</div>

<div id="resultadosVelada"></div>

@include('footer')

</body>
</html>
