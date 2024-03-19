function MostrarVeladasTabla(veladas) {
    var tablaHTML = "<table border='1'><tr><th>Nombre</th><th>Fecha</th><th>Localización</th><th>Acciones</th></tr>";
    veladas.forEach(function(velada) {
        tablaHTML += "<tr>";
        tablaHTML += "<td>" + velada.Nombre_Vel + "</td>";
        tablaHTML += "<td>" + velada.Fecha_Vel + "</td>";
        tablaHTML += "<td>" + velada.Nombre_Loc + "</td>"; // Corregir aquí para acceder al nombre de la Localización
        tablaHTML += "<td><button onclick='eliminarVelada(" + velada.ID_Velada + ")'>Eliminar</button>";
        tablaHTML += "<button onclick='editarVelada(" + velada.ID_Velada + ")'>Editar</button></td>"; // Nuevo botón de Editar
        tablaHTML += "</tr>";
    });
    tablaHTML += "</table>";
    document.getElementById("resultadoVelada").innerHTML = tablaHTML;
}

function agregarVelada() {
    window.location.href = "http://127.0.0.1:8000/velada/agregar";
}

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

function editarVelada(ID_Velada) {
    window.location.href = "http://127.0.0.1:8000/velada/editar/" + ID_Velada; // Redireccionar a la página de edición
}

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
