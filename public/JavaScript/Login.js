// Función para realizar la autenticación del usuario
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

// Función para generar el token

function generarToken() {

}

// Función para añadir el token a la API
function addTokenToAPI(){

}

// Vincular el evento de clic al botón de inicio de sesión
$('#loginButton').click(login);


/*
Estructura del login:

login.js=
    1- login
    2- logout
    3- comprobar sesion

Modelo usuario=
    1- comprobar usuario
    2- comprobar sesion
    3- token

Controller usuario=
    1- validacion login
    2- cerrarSesion
    3- lougout
    4- checksession

    -------------------------------------------------------
Modelo validacion=
    Igual
Controller validacion=
    crud

web.php=
    1- login
    2- logout
    3- cheksession


*/
