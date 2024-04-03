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

function checkToken() {

}


