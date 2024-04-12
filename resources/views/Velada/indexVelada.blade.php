<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="estilos.css">
  <title>Veladas</title>
  <script src="JavaScript/FuncionesVelada.js"></script>
</head>

@include('header')

<body onload="obtenerVelada()">

<h2>Velada</h2>

<div id="resultadoVelada"></div>

<div id="PeleasVeladas"></div>

<a href="{{ route('velada/insertar') }}">Insertar Velada</a>

</body>

@include('footer')

</html>
