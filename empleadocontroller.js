$(document).ready(function() {
    // Array para almacenar los valores de las actividades
    window.conserjesArray = [];

    // Función para agregar actividad a la lista y valor al array
    $("#agregar-empleado").click(function() {
        var conserjeText = $("#conserjes option:selected").text();
        var conserjeValue = $("#conserjes").val();
        if (conserjeValue !== "") {
            //console.log("BUENOS DIAS");
            conserjesArray.push(conserjeValue); // Agrega el valor al array
            //$("#actividades-agregadas").append("<li>" + actividadText + " <button type='button' class='btn btn-danger btn-circle btn-sm eliminar-actividad'>S</button></li>");
            $("#empleados-asignados").append("<li><i class='fa-solid fa-address-card mr-3'></i>" + conserjeText + " <i class='eliminar-emp fas fa-trash-alt btn-sm btn-danger'></i></li>");
            console.log(conserjesArray);
            $("#conserjes").val($("#conserjes option:first").val()); // Establece el valor del select en el índice 0
        }
    });
    $(document).on("click", ".eliminar-emp", function() {
        var index = $(this).parent().index(); // Obtiene el índice del elemento a eliminar
        conserjesArray.splice(index, 1); // Elimina el valor del array
        $(this).parent().remove(); // Elimina la actividad de la lista
        console.log(conserjesArray);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById("enviar-formulario").addEventListener("click", function() {
        var idSolicitud = document.getElementById("id-solicitud").value;

        console.log(idSolicitud);
        console.log(conserjesArray);
        console.log('STARTING...');

        /*console.log(typeof area);
        console.log("area");*/

        const nuevoPersonal = new ListaConserjes(idSolicitud,conserjesArray);
        nuevoPersonal.showData();
        
        // Llamamos al método enviarSolicitud del objeto Solicitud
        nuevoPersonal.asignarPersonal("asignarp.php", function(error, respuesta) {
            if (error) {
                mostrarMensaje(error);
            } else {
                mostrarMensaje(respuesta);
            }
        });
    });
});

function mostrarMensaje(mensaje) {
    console.log(mensaje);
    
    // Crear elemento de div para el mensaje
    const mensajeDiv = document.createElement('div');
    mensajeDiv.textContent = mensaje;
    // Establecer estilos
    mensajeDiv.style.position = 'fixed';
    mensajeDiv.style.top = '50%';
    mensajeDiv.style.left = '50%';
    mensajeDiv.style.transform = 'translate(-50%, -50%)';
    mensajeDiv.style.backgroundColor = 'white';
    mensajeDiv.style.padding = '20px';
    mensajeDiv.style.border = '2px solid black';
    mensajeDiv.style.borderRadius = '5px';
    mensajeDiv.style.zIndex = '9999';

    // Añadir mensaje al cuerpo del documento
    document.body.appendChild(mensajeDiv);

    // Cerrar mensaje después de 5 segundos
    setTimeout(function() {
        document.body.removeChild(mensajeDiv);
        // Recargar la página
        location.reload();
    }, 5000);
}
