$(document).ready(function() {
    $('#submitBtn').click(function() {
        // Obtener los valores del formulario
        var usuario = $('#usuario').val();
        var contrasena = $('#contrasena').val();

        // Crear el objeto JSON con los datos del formulario
        var datos = {
            usuario: usuario,
            contrasena: contrasena
        };

        // Enviar los datos al servidor con AJAX
        $.ajax({
            type: 'POST',
            url: 'autenticacion.php',
            data: datos,
            dataType: 'json',
            success: function(response) {
                // Redireccionar a la página correspondiente según la respuesta del servidor
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX: ' + status + ', ' + error);
            }
        });
    });
});
