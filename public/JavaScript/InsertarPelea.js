// Función para filtrar participantes por categoría
function filtrarParticipantesPorCategoria() {
    var selectedCategoryId = $('#select-Categoria').val();
    var selectParticipanteAzul = $('#select-Participante-Azul');
    var selectParticipanteRojo = $('#select-Participante-Rojo');


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
                $.each(data, function(index, participante) {
                    selectParticipanteAzul.append(`<option value="${participante.ID_Participante}">${participante.Nombre_Par}</option>`);
                    selectParticipanteRojo.append(`<option value="${participante.ID_Participante}">${participante.Nombre_Par}</option>`);
                });
            },
            error: function(error) {
                console.error('Error al cargar participantes por categoría:', error);
            }
        });
    }
}


// Cargar categorías
function cargarCategorias() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Categoria',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectCategoria = $('#select-Categoria');
            $.each(data.data, function(index, categoria) {
                selectCategoria.append(`<option value="${categoria.ID_Categoria}">${categoria.Nombre_Cat}</option>`);
            });
        },
        error: function(error) {
            console.error('Error al cargar categorías:', error);
        }
    });
}

// Cargar veladas
function cargarVeladas() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Velada',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectVelada = $('#select-Velada');
            $.each(data, function(index, velada) {
                selectVelada.append(`<option value="${velada.ID_Velada}">${velada.Nombre_Vel}</option>`);
            });
        },
        error: function(error) {
            console.error('Error al cargar veladas:', error);
        }
    });
}

// Función para agregar una pelea
function agregarPelea() {
    var nombrePelea = $('#nombre-Pelea').val();
    var participanteAzul = $('#select-Participante-Azul').val();
    var participanteRojo = $('#select-Participante-Rojo').val();
    var juez = $('#select-Juez').val();
    var arbitro = $('#select-Arbitro').val();
    var velada = $('#select-Velada').val();

    var data = {
        'Nombre_Pel': nombrePelea,
        'ID_Participante_Azul': participanteAzul,
        'ID_Participante_Rojo': participanteRojo,
        'ID_Juez': juez,
        'ID_Arbitro': arbitro,
        'ID_Velada': velada
    };

    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Pelea',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            console.log('Pelea agregada:', response);
            $('#resultadosPelea').text('Pelea agregada correctamente');
            window.location.href = "/peleas";
        },
        error: function(error) {
            console.error('Error:', error);
            $('#resultadosPelea').text('Error al agregar pelea');
        },
        complete: function() {
            $('#agregarPeleaBtn').prop('disabled', false);
        }
    });
}
