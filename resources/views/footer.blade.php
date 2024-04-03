<footer>
    <div class="container">
        <p style="color: white">&copy; {{ date('Y') }} Joel Acoran Cruz Morales - Proyecto de Final de Ciclo de Desarrollo de Aplicaciones Web</p>
    </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const auth_token = sessionStorage.getItem('auth_token');
            if (auth_token === null) {
                alert("Usuario no autenticado, redireccionando a /login...");
                window.location.href = '/login';
            }
        });
        </script>
</footer>
