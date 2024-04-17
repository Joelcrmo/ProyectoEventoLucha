<footer>
    <div class="container">
        <p style="color: rgb(255, 255, 255)">&copy; {{ date('Y') }} Joel Acoran Cruz Morales - Proyecto de Final de Ciclo de Desarrollo de Aplicaciones Web</p>
    </div>

    <noscript>
        <meta http-equiv="refresh" content="0;url=/js-disabled">
    </noscript>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JavaScript/Login.js"></script>
    <script>
        $(document).ready(function() {
            const auth_token = sessionStorage.getItem('auth_token');
            if (auth_token) {
                const userToken = JSON.parse(auth_token);
                check_Token(userToken.ID_Usuario, userToken.token, null, '/login');
            } else {
                alert("Usuario no autenticado, redireccionando a /login...");
                window.location.href = '/login'; // Redirigir a la página de inicio de sesión
            }
        });
    </script>
</footer>
