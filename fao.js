// Función para enviar los datos del formulario al servidor mediante AJAX
function enviarFormulario() {
    // Obtener los valores del formulario
    var usuario = $('#nombreid').val();
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
  }
  
  // Define la función que deseas ejecutar cuando la validación sea exitosa
  function onSubmitSuccess(event) {
    event.preventDefault(); // Evita la acción predeterminada del formulario
    console.log('¡Formulario enviado correctamente!');
    console.log('Cambios Aplicados');
  
    // Llama a la función para enviar el formulario al servidor
    //enviarFormulario();
    // Retrasar la ejecución de enviarFormulario() por 10 segundos
    setTimeout(enviarFormulario, 3000); // 10000 milisegundos = 10 segundos
  }
  
  (() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                // Si el formulario es válido, ejecuta la función onSubmitSuccess
                onSubmitSuccess(event);
            }
  
            form.classList.add('was-validated')
        }, false)
    })
  })()