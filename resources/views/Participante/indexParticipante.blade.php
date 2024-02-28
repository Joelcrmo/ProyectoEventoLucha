<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="estilos.css">
  <title>Participantes</title>
  <script src="JavaScript/VistaParticipantes.js"></script>
</head>
 @include('header')

<body onload="obtenerDatosParticipantes()">

<h2>Atletas</h2>

<h3>Filtros por categoria</h3>
  <select id="selectCategoria" onchange="filtrarPorCategoria()">
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
    <option value="todos">Mostrar todos los participantes </option>
  </select>

  <h3>Filtros por Tecnica</h3>
  <select id="selectTecnica" onchange="filtrarPorTecnica()">
    <option value="">Selecciona una técnica</option>
    <option value="1">Brazilian Jiu Jitsu</option>
    <option value="2">Boxeo</option>
    <option value="3">Kick Boxing</option>
    <option value="4">Wresling</option>
    <option value="5">Muay Thai</option>
    <option value="6">Judo</option>
    <option value="7">Jiu Jitsu</option>
  </select>


  <button onclick="filtrarArbitrosYJueces()">Mostrar Árbitros y Jueces</button>

  <div id="resultadosParticipante"></div>

</body>


@include('footer')
</html>


