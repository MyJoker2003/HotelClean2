function eliminarRegistro(idSolicitud) {
    $.ajax({
        url: 'delete.php', // Ruta al archivo PHP que manejará la eliminación
        type: 'POST',
        data: {id_solicitud: idSolicitud}, // Envía el ID de la solicitud al PHP
        success: function(response) {
            // Recarga la página después de eliminar el registro
            window.location.reload();
        }
    });
}

$(document).ready(function() {
    // Agrega un evento de clic a todos los elementos con la clase 'eliminar-registro'
    $('.eliminar-registro').click(function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        var idSolicitud = $(this).data('id'); // Obtiene el ID de la solicitud
        // Muestra el modal de confirmación
        $('#confirmarEliminarModal').modal('show');
        // Desvincula todos los eventos de clic asociados a #confirmarEliminar
        $('#confirmarEliminar').off('click');
        // Agrega un evento de clic al botón 'Eliminar' dentro del modal
        $('#confirmarEliminar').click(function() {
            eliminarRegistro(idSolicitud);
            //alert(idSolicitud);
        });
    });
});
