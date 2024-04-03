// Login function
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

// Generate token
function generate_token(ID_Usuario) {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/joel/Validacion' + '/' + ID_Usuario,
        type: 'POST',
        data: {
            ID_Usuario: ID_Usuario
        },
        success: function(response) {
            const token = response.token;
            userToken = {
                ID_Usuario: ID_Usuario,
                token : token
            };
            userTokenJSON = JSON.stringify(userToken);
            sessionStorage.setItem('auth_token', userTokenJSON);
            window.location.href = '/';
        },
        error: function(xhr, status, error) {
            console.error('Error al generar el token. Estado:', status, 'Error:', error);
            alert('Error al generar el token');
        }
    });
}

// Login Button
$('#loginButton').click(login);

function check_Token(ID_Usuario, token, login_true = null, login_false = null) {
    const url = 'http://127.0.0.1:8000/api/joel/Validacion';
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            let tokens = response.data;

            // Recorro todos los tokens que me devuelve la query
            tokens.forEach(tokenData => {

                // Si el token es el mismo
                if (tokenData.token === token && tokenData.ID_Usuario === ID_Usuario) {
                    // Obtengo la fecha de hoy y las fechas de creacion y expiracion
                    let currentDate = new Date();
                    let fechaCreacion = new Date(tokenData.Fecha_creacion);
                    let fechaExpiracion = new Date(tokenData.Fecha_expiracion);

                    // Compruebo si la fecha de hoy está entre la fecha de creación y la fecha de expiración
                    if (currentDate >= fechaCreacion && currentDate <= fechaExpiracion) {
                        if (login_true !== null) {
                            alert("Sesión iniciada");
                            window.location.href = login_true;
                        }
                    } else {
                        alert("Su sesión ha expirado");
                        if (login_false !== null) {
                            window.location.href = login_false;
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los tokens. Estado:', status, 'Error:', error);
            alert('Error al validar el token');
        }
    });
}

