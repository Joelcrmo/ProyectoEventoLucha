function login() {
    const username = $('#username').val();
    const password = $('#password').val();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Usuario',
        type: 'GET',
        success: function(data) {
            if (data && data.data.length > 0) {
                const user = data.data[0];
                if (user.Nombre_Usu === username && user.Password_Usu === password) {
                    // Si el usuario y la contraseña son correctos, llamamos a generate_token con el ID_Usuario
                    generate_token(user.ID_Usuario);
                } else {
                    alert('Usuario o contraseña incorrecta');
                }
            } else {
                alert('Usuario no encontrado');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los datos del usuario. Estado:', status, 'Error:', error);
            alert('Error al realizar la autenticación');
        }
    });
}

function generate_token(ID_Usuario) {
    // Enviamos una solicitud POST a la ruta de Validacion con el ID_Usuario
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Validacion',
        type: 'POST',
        data: {
            ID_Usuario: ID_Usuario // Pasamos el ID_Usuario como parámetro
        },
        success: function(response) {
            const token = response.token;
            localStorage.setItem('auth_token', token); // Almacenamos el token en el almacenamiento local
            window.location.href = '/'; // Redireccionamos a la página principal
        },
        error: function(xhr, status, error) {
            console.error('Error al generar el token. Estado:', status, 'Error:', error);
            alert('Error al generar el token');
        }
    });
}

// Vincular el evento de clic al botón de inicio de sesión
$('#loginButton').click(login);
