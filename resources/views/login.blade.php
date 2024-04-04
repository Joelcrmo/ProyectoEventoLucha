<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="estilos.css">
  <title>Login</title>
  <script src="{{ asset('JavaScript/Login.js') }}" defer></script>
</head>
<body>
  <h2>Login</h2>
  <div id="FormularioLogin">
    <form>
      <label for="username" style="color: white">Nombre de usuario:</label><br>
      <input type="text" id="username" name="username"><br>
      <label for="password" style="color: white">Contraseña:</label><br>
      <input type="password" id="password" name="password"><br><br>
      <button type="button" id="loginButton">Iniciar sesión</button>
    </form>
  </div>

</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="JavaScript/Login.js"></script>

    <script>
        $(document).ready(function() {
            const auth_token = sessionStorage.getItem('auth_token');
            if (auth_token) {
                const userToken = JSON.parse(auth_token);
                check_Token(userToken.ID_Usuario, userToken.token, '/', null);
            }
        });
    </script>

</footer>
</html>
