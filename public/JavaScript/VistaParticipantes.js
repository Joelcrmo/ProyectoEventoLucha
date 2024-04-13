// Obtener datos
function obtenerDatosParticipantes() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/api/joel/Participante", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                participantes = JSON.parse(xhr.responseText);
                MostrarLuchadoresTabla(participantes);
                filtrarPorCategoria();
            } else {
                console.error("Error al obtener los participantes. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Mostrar tablas
function MostrarLuchadoresTabla(datos) {
    if (datos.hasOwnProperty("data")) {
        var participantes = datos.data;
        var tablaHTML = "<table border='1'><tr><th>Nombre</th><th>Apellido</th><th>Rol</th><th>Tecnica</th><th>Altura</th><th>Peso</th><th>País</th><th>Categoría</th></tr>";
        participantes.forEach(function(participante) {
            tablaHTML += "<tr>";
            tablaHTML += "<td>" + participante.Nombre_Par + "</td>";
            tablaHTML += "<td>" + participante.Apellido_Par + "</td>";
            tablaHTML += "<td>" + (participante.rol ? participante.rol.Nombre_Rol : '') + "</td>";
            tablaHTML += "<td>" + (participante.tecnica ? participante.tecnica.Nombre_Tecnica : '') + "</td>";
            tablaHTML += "<td>" + participante.Altura_Par + "</td>";
            tablaHTML += "<td>" + participante.Peso_Par + "</td>";
            tablaHTML += "<td>" + (participante.pais ? participante.pais.Nombre_Pais : '') + "</td>";
            tablaHTML += "<td>" + (participante.categoria ? participante.categoria.Nombre_Cat : '') + "</td>";
            tablaHTML += "</tr>";
        });
        tablaHTML += "</table>";
        document.getElementById("resultados-Participante").innerHTML = tablaHTML;
    } else {
        console.error("La estructura de datos no contiene la clave 'data'");
    }
}

// Mostrar tablas de arbitros y jueces
function MostrarArbitrosJuecesTabla(datos) {
    if (datos.hasOwnProperty("data")) {
        var participantes = datos.data;
        var tablaHTML = "<table border='1'><tr><th>Nombre</th><th>Apellido</th><th>Rol</th><th>País</th></tr>";
        participantes.forEach(function(participante) {
            tablaHTML += "<tr>";
            tablaHTML += "<td>" + participante.Nombre_Par + "</td>";
            tablaHTML += "<td>" + participante.Apellido_Par + "</td>";
            tablaHTML += "<td>" + (participante.rol ? participante.rol.Nombre_Rol : '') + "</td>";
            tablaHTML += "<td>" + (participante.pais ? participante.pais.Nombre_Pais : '') + "</td>";
            tablaHTML += "</tr>";
        });
        tablaHTML += "</table>";
        document.getElementById("resultados-Participante").innerHTML = tablaHTML;
    } else {
        console.error("La estructura de datos no contiene la clave 'data'");
    }
}

// Filtros por categorias
function filtrarPorCategoria() {
    var selectElement = document.getElementById("select-Categoria");
    var selectedCategoryId = selectElement.value;
    var resultadosDiv = document.getElementById("resultados-Participante");

    document.getElementById("select-Tecnica").value = "";

    if (selectedCategoryId === "todos") {
        MostrarLuchadoresTabla(participantes);
        resultadosDiv.style.display = "block";
    } else if (selectedCategoryId !== "") {
        if (participantes && participantes.data) {
            var participantesFiltrados = participantes.data.filter(function(participante) {
                return participante.ID_Categoria.toString() === selectedCategoryId &&
                       participante.rol.ID_Rol !== 2 && participante.rol.ID_Rol !== 3;
            });

            MostrarLuchadoresTabla({ "data": participantesFiltrados });
            resultadosDiv.style.display = "block";
        } else {
            console.error("Error: no se han cargado los datos de los participantes correctamente.");
        }
    } else {
        resultadosDiv.style.display = "none";
    }
}

// Filtros por arbitros y jueces
function filtrarArbitrosYJueces() {
    var resultadosDiv = document.getElementById("resultados-Participante");

    document.getElementById("select-Tecnica").value = "";
    document.getElementById("select-Categoria").value = "";

    if (participantes && participantes.data) {
        var arbitrosYJueces = participantes.data.filter(function(participante) {
            return participante.rol.ID_Rol === 2 || participante.rol.ID_Rol === 3;
        });

        MostrarArbitrosJuecesTabla({ "data": arbitrosYJueces });
        resultadosDiv.style.display = "block";
    } else {
        console.error("Error: no se han cargado los datos de los participantes correctamente.");
    }
}

// Filtros por tecnica
function filtrarPorTecnica() {
    var selectElement = document.getElementById("select-Tecnica");
    var selectedTecnicaId = selectElement.value;
    var resultadosDiv = document.getElementById("resultados-Participante");

    document.getElementById("select-Categoria").value = "";

    if (selectedTecnicaId === "") {
        MostrarLuchadoresTabla(participantes);
        resultadosDiv.style.display = "block";
    } else {
        if (participantes && participantes.data) {
            var participantesFiltrados = participantes.data.filter(function(participante) {
                return participante.tecnica && participante.tecnica.ID_Tecnica.toString() === selectedTecnicaId;
            });

            if (participantesFiltrados.length > 0) {
                MostrarLuchadoresTabla({ "data": participantesFiltrados });
                resultadosDiv.style.display = "block";
            } else {
                resultadosDiv.style.display = "none";
            }
        } else {
            console.error("Error: no se han cargado los datos de los participantes correctamente.");
        }
    }
}
