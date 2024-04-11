// Función para cargar las localizaciones desde la API
function cargarLocalizaciones() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Localizacion/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectLocalizacion = $('#selectLocalizacion');
            $.each(data, function(localizacion) {
                selectLocalizacion.append(`<option value="${localizacion.ID_Localizacion}">${localizacion.Nombre_Localizacion}</option>`);
            });
        },
        error: function(error) {
            console.error('Error al cargar localizaciones:', error);
        }
    });
}

// Función para agregar una velada
function agregarVelada() {
    var nombreVelada = $('#nombreVelada').val();
    var fechaVelada = $('#fechaVelada').val();
    var localizacion = $('#selectLocalizacion').val();

    var data = {
        'Nombre_Vel': nombreVelada,
        'ID_Localizacion': localizacion,
        'Fecha_Vel': fechaVelada
    };

    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Velada',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            console.log('Velada agregada:', response);
            $('#resultadosVelada').text('Velada agregada correctamente');
            window.location.href = '/velada';

        },
        error: function(error) {
            console.error('Error:', error);
            $('#resultadosVelada').text('Error al agregar velada');
        },
        complete: function() {
            $('#agregarVeladaBtn').prop('disabled', false);
        }
    });
}
