<footer>
    <div class="container">
        <p style="color: rgb(255, 255, 255)">&copy; {{ date('Y') }} Joel Acoran Cruz Morales - Proyecto de Final de Ciclo de Desarrollo de Aplicaciones Web</p>
    </div>

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
                window.location.href = '/login';
            }

            // Verificar si JavaScript está habilitado
            var javascriptEnabled = document.createElement('div');
            javascriptEnabled.id = 'javascript-enabled';
            javascriptEnabled.style.display = 'none'; // Ocultar por defecto

            // Agregar el elemento al final del body
            document.body.appendChild(javascriptEnabled);

            // Verificar la visibilidad del elemento
            if (javascriptEnabled.offsetParent === null) {
                // El elemento no es visible (JavaScript está deshabilitado)
                window.location.href = '{{ route('js.disabled') }}'; // Redireccionar a la ruta indicando JavaScript deshabilitado
            }

            // Remover el elemento después de verificar
            document.body.removeChild(javascriptEnabled);
        });
    </script>
</footer>
