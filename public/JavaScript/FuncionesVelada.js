// Función para mostrar las veladas
function MostrarVeladasTabla(veladas) {
    var tablaHTML = "<table border='1'><tr><th>Nombre</th><th>Fecha</th><th>Localización</th><th>Acciones</th></tr>";
    veladas.forEach(function(velada) {
        tablaHTML += "<tr>";
        tablaHTML += "<td>" + velada.Nombre_Vel + "</td>";
        tablaHTML += "<td>" + velada.Fecha_Vel + "</td>";
        tablaHTML += "<td>" + velada.Nombre_Loc + "</td>";
        tablaHTML += "<td><button onclick='eliminarVelada(" + velada.ID_Velada + ")'>Eliminar</button>";
        tablaHTML += "<button onclick='editarVelada(" + velada.ID_Velada + ")'>Editar</button>";
        tablaHTML += "<button onclick='verPeleasVelada(" + velada.ID_Velada + ")'>Ver Peleas</button></td>";
        tablaHTML += "</tr>";
    });
    tablaHTML += "</table>";
    document.getElementById("resultadoVelada").innerHTML = tablaHTML;
}

// Función para mostrar las peleas de una velada específica
function verPeleasVelada(ID_Velada) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/api/joel/Velada/" + ID_Velada + "/peleas", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var peleas = JSON.parse(xhr.responseText);
                MostrarPeleasVelada(peleas);
            } else {
                console.error("Error al obtener las peleas de la velada. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Función para mostrar las peleas de una velada en el elemento PeleasVeladas
function MostrarPeleasVelada(peleas) {
    var peleasHTML = "<h3>Peleas de la Velada</h3><ul>";
    peleas.forEach(function(pelea) {
        peleasHTML += "<li>" + pelea.Nombre_Pelea + " - " + pelea.Categoria_Pelea + "</li>";
    });
    peleasHTML += "</ul>";
    document.getElementById("PeleasVeladas").innerHTML = peleasHTML;
}

// Función para eliminar una velada
function eliminarVelada(ID_Velada) {
    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", "http://127.0.0.1:8000/api/joel/Velada/" + ID_Velada, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                obtenerVelada();
            } else {
                console.error("Error al eliminar la velada. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Función para editar una velada
function editarVelada(ID_Velada) {
    window.location.href = "http://127.0.0.1:8000/velada/editar/" + ID_Velada; // Redireccionar a la página de edición
}

// Función para obtener todas las veladas
function obtenerVelada() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/api/joel/Velada", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var veladas = JSON.parse(xhr.responseText);
                MostrarVeladasTabla(veladas);
            } else {
                console.error("Error al obtener los datos de la velada. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

obtenerVelada();
