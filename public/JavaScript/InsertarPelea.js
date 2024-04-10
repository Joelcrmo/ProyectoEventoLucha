function filtrarParticipantesPorCategoria() {
    var selectedCategoryId = $('#selectCategoria').val();
    var selectParticipanteAzul = $('#selectParticipanteAzul');
    var selectParticipanteRojo = $('#selectParticipanteRojo');

    selectParticipanteAzul.empty();
    selectParticipanteRojo.empty();

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

function cargarCategorias() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Categoria',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectCategoria = $('#selectCategoria');
            $.each(data.data, function(index, categoria) {
                selectCategoria.append(`<option value="${categoria.ID_Categoria}">${categoria.Nombre_Cat}</option>`);
            });
        },
        error: function(error) {
            console.error('Error al cargar categorías:', error);
        }
    });
}

function cargarVeladas() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Velada',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectVelada = $('#selectVelada');
            $.each(data, function(index, velada) {
                selectVelada.append(`<option value="${velada.ID_Velada}">${velada.Nombre_Vel}</option>`);
            });
        },
        error: function(error) {
            console.error('Error al cargar veladas:', error);
        }
    });
}

function agregarPelea() {
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
