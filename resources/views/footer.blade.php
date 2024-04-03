<footer>
    <div class="container">
        <p style="color: white">&copy; {{ date('Y') }} Joel Acoran Cruz Morales - Proyecto de Final de Ciclo de Desarrollo de Aplicaciones Web</p>
    </div>

    <!-- Carga de Login.js -->
    <script src="public/JavaScript/Login.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const auth_token = sessionStorage.getItem('auth_token');
            if (auth_token !== null) {
                const userToken = JSON.parse(auth_token);
                // Llama a la función check_Token de Login.js
                check_Token(userToken.ID_Usuario, userToken.token, '/', '/login');
                alert("Sesión iniciada");
            } else {
                alert("Usuario no autenticado, redireccionando a /login...");
                window.location.href = '/login';
            }
        });
    </script>
</footer>
