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
    document.getElementById("resultado-Velada").innerHTML = tablaHTML;
}

// Función para mostrar las peleas de una velada específica
function verPeleasVelada(ID_Velada) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/api/joel/Pelea?ID_Velada=" + ID_Velada, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var peleas = JSON.parse(xhr.responseText);
                if (peleas.length === 0) {
                    alert("No hay peleas en esta velada");
                } else {
                    MostrarPeleasVelada(peleas);
                }
            } else {
                console.error("Error al obtener las peleas de la velada. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Función para mostrar las peleas de una velada en el elemento PeleasVeladas
function MostrarPeleasVelada(peleas) {
    // Verificar si hay peleas
    if (peleas.length === 0) {
        var VeladaVacia = "<br><span style='color: red;'>No hay Pelea en esta velada</span>";
        document.getElementById("Peleas-Veladas").innerHTML = VeladaVacia;
        return;
    }

    // Función para obtener el nombre de un participante por su ID
    function obtenerNombreParticipante(ID_Participante, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://127.0.0.1:8000/api/joel/Participante/" + ID_Participante, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    callback(response.Nombre_Par);
                } else {
                    console.error("Error al obtener el nombre del participante. Código de estado:", xhr.status);
                    callback("Error al obtener el nombre");
                }
            }
        };
        xhr.send();
    }

    // Iterar sobre cada pelea y obtener nombres
    peleas.forEach(function(pelea) {
        obtenerNombreParticipante(pelea.ID_Participante_Azul, function(nombreAzul) {
            pelea.Nombre_Participante_Azul = nombreAzul;
            obtenerNombreParticipante(pelea.ID_Participante_Rojo, function(nombreRojo) {
                pelea.Nombre_Participante_Rojo = nombreRojo;
                // Una vez que se obtengan todos los nombres, mostrar la tabla
                mostrarPeleasTabla(peleas);
            });
        });
    });
}

// Función para mostrar la tabla de peleas de una velada
function mostrarPeleasTabla(peleas) {
    var tablaHTML = "<table border='1'><tr><th>Velada</th><th>Nombre</th><th>Participante Azul</th><th>Participante Rojo</th></tr>";
    peleas.forEach(function(pelea) {
        tablaHTML += "<tr>";
        tablaHTML += "<td>" + pelea.Nombre_Vel + "</td>";
        tablaHTML += "<td>" + pelea.Nombre_Pel + "</td>";
        tablaHTML += "<td>" + pelea.Nombre_Participante_Azul + "</td>";
        tablaHTML += "<td>" + pelea.Nombre_Participante_Rojo + "</td>";
        tablaHTML += "</tr>";
    });
    tablaHTML += "</table>";
    document.getElementById("Peleas-Veladas").innerHTML = tablaHTML;
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
