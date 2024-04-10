$(document).ready(function() {
    // Función para cargar las veladas al cargar la página
    cargarVeladas();

    // Función para filtrar los participantes por categoría al cambiar la categoría seleccionada
    $('#selectCategoria').change(function() {
        filtrarParticipantesPorCategoria();
    });

    // Función para cargar los datos de la pelea a editar
    cargarDatosPelea();

    $('#editarPeleaBtn').click(function() {
        guardarCambios();
    });
    // Evento click para enviar los datos actualizados al servidor
    $('#editarPeleaBtn').click(function() {
        $(this).prop('disabled', true);
        editarPelea();
    });
});

// Función para cargar los datos de la pelea a editar
function cargarDatosPelea() {
    var peleaId = obtenerParametroURL('id'); // Obtener el ID de la pelea de la URL
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Pelea/' + peleaId, // URL para obtener los datos de la pelea
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Rellenar los campos del formulario con los datos de la pelea obtenidos
            $('#nombrePelea').val(data.Nombre_Pel);
            $('#selectCategoria').val(data.ID_Categoria).change(); // Seleccionar la categoría y desencadenar el evento change para filtrar los participantes
            $('#selectParticipanteAzul').val(data.ID_Participante_Azul);
            $('#selectParticipanteRojo').val(data.ID_Participante_Rojo);
            $('#selectJuez').val(data.ID_Juez);
            $('#selectArbitro').val(data.ID_Arbitro);
            $('#selectVelada').val(data.ID_Velada);
        },
        error: function(error) {
            console.error('Error al cargar datos de la pelea:', error);
        }
    });
}

// Función para enviar los datos actualizados de la pelea al servidor
function editarPelea() {
    var peleaId = obtenerParametroURL('id'); // Obtener el ID de la pelea de la URL
    var nombrePelea = $('#nombrePelea').val();
    var participanteAzul = $('#selectParticipanteAzul').val();
    var participanteRojo = $('#selectParticipanteRojo').val();
    var juez = $('#selectJuez').val();
    var arbitro = $('#selectArbitro').val();
    var velada = $('#selectVelada').val();

    var data = {
        'Nombre_Pel': nombrePelea,
        'ID_Participante_Azul': participanteAzul,
        'ID_Participante_Rojo': participanteRojo,
        'ID_Juez': juez,
        'ID_Arbitro': arbitro,
        'ID_Velada': velada
    };

    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Pelea/' + peleaId, // URL para editar la pelea
        type: 'PUT',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            console.log('Pelea editada:', response);
            $('#resultadosPelea').text('Pelea editada correctamente');
            window.location.href = "/peleas";
        },
        error: function(error) {
            console.error('Error al editar pelea:', error);
            $('#resultadosPelea').text('Error al editar pelea');
            $('#editarPeleaBtn').prop('disabled', false);
        }
    });
}

// Función para obtener un parámetro de la URL por su nombre
function obtenerParametroURL(nombre) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nombre);
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
