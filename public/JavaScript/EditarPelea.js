// Función para obtener los detalles de una pelea específica
function obtenerDetallesPelea(ID_Pelea) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/api/joel/Pelea/" + ID_Pelea, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var pelea = JSON.parse(xhr.responseText);
                mostrarDetallesPelea(pelea);
            } else {
                console.error("Error al obtener los detalles de la pelea. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Función para mostrar los detalles de la pelea en el formulario de edición
function mostrarDetallesPelea(pelea) {
    document.getElementById("nombrePelea").value = pelea.Nombre_Pel;
    document.getElementById("selectParticipanteAzul").value = pelea.ID_Participante_Azul;
    document.getElementById("selectParticipanteRojo").value = pelea.ID_Participante_Rojo;
    document.getElementById("selectJuez").value = pelea.ID_Juez;
    document.getElementById("selectArbitro").value = pelea.ID_Arbitro;
    document.getElementById("selectVelada").value = pelea.ID_Velada;
}

// Función para enviar los cambios de la pelea al servidor para su edición
function guardarCambiosPelea(ID_Pelea) {
    var nombrePelea = document.getElementById("nombrePelea").value;
    var participanteAzul = document.getElementById("selectParticipanteAzul").value;
    var participanteRojo = document.getElementById("selectParticipanteRojo").value;
    var juez = document.getElementById("selectJuez").value;
    var arbitro = document.getElementById("selectArbitro").value;
    var velada = document.getElementById("selectVelada").value;

    var data = {
        'Nombre_Pel': nombrePelea,
        'ID_Participante_Azul': participanteAzul,
        'ID_Participante_Rojo': participanteRojo,
        'ID_Juez': juez,
        'ID_Arbitro': arbitro,
        'ID_Velada': velada
    };

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", "http://127.0.0.1:8000/api/joel/Pelea/" + ID_Pelea, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Pelea actualizada:', xhr.responseText);
                window.location.href = "/peleas"; // Redirigir a la página de peleas después de la edición
            } else {
                console.error("Error al guardar los cambios de la pelea. Código de estado:", xhr.status);
            }
        }
    };
    xhr.send(JSON.stringify(data));
}

// Obtener ID de Pelea desde la URL
var url = window.location.href;
var ID_Pelea = url.substring(url.lastIndexOf("/") + 1);

