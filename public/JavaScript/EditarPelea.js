$(document).ready(function() {
    $('#select-Categoria').change(function() {
        console.log('Evento change activado');
        filtrarParticipantesPorCategoria();
    });
    cargarDatosPelea();
    $('#editar-Pelea-Btn').click(function() {
        $(this).prop('disabled', true);
        guardarCambios();
        editarPelea();
    });
});

// Función para cargar los datos de la pelea a editar
function cargarDatosPelea() {
    console.log("Cargando datos de la pelea...");
    var peleaId = obtenerParametroURL('id');
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Pelea/' + peleaId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#nombrePelea').val(data.Nombre_Pel);
            $('#selectCategoria').val(data.ID_Categoria);
            $('#selectCategoria').trigger('change');
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

// Función para enviar los cambios de la pelea al servidor para su edición
function guardarCambiosPelea(ID_Pelea) {
    var nombrePelea = document.getElementById("nombre-Pelea").value;
    var participanteAzul = document.getElementById("select-Participante-Azul").value;
    var participanteRojo = document.getElementById("select-Participante-Rojo").value;
    var juez = document.getElementById("select-Juez").value;
    var arbitro = document.getElementById("select-Arbitro").value;
    var velada = document.getElementById("select-Velada").value;

    if (!nombrePelea.match(/^[a-zA-Z0-9\s]{4,25}$/)) {
        $('#resultadosPelea').text('El nombre de la pelea debe tener entre 4 y 25 caracteres alfanuméricos sin caracteres especiales.');
        return;
    }
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

function filtrarParticipantesPorCategoria() {
    console.log('Filtrando participantes por categoría...');
    var selectedCategoryId = $('#select-Categoria').val();
    var selectParticipanteAzul = $('#select-Participante-Azul');
    var selectParticipanteRojo = $('#select-Participante-Rojo');

    // Limpiar selectores de participantes
    selectParticipanteAzul.empty().append($('<option>', {
        value: '',
        text: 'Selecciona un participante'
    }));
    selectParticipanteRojo.empty().append($('<option>', {
        value: '',
        text: 'Selecciona un participante'
    }));

    if (selectedCategoryId) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/joel/Categoria/' + selectedCategoryId + '/Participantes',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                data.forEach(function(participante) {
                    selectParticipanteAzul.append($('<option>', {
                        value: participante.ID_Participante,
                        text: participante.Nombre_Par
                    }));
                    selectParticipanteRojo.append($('<option>', {
                        value: participante.ID_Participante,
                        text: participante.Nombre_Par
                    }));
                });
            },
            error: function(error) {
                console.error('Error al cargar participantes por categoría:', error);
            }
        });
    }
}

