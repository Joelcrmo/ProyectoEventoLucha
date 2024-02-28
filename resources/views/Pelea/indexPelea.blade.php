<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="estilos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>Peleas</title>
  <script src="JavaScript/FuncionesPelea.js"></script>

</head>
 @include('header')

<body onload="obtenerPelea()">

<h2>Peleas</h2>

<div id="resultadosPelea"></div>

<a href="{{ route('peleas/insertar') }}">Insertar pelea</a>

</body>


@include('footer')
</html>


