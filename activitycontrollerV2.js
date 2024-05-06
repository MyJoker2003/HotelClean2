$(document).ready(function() {
    // Array para almacenar los valores de las actividades
    window.actividadesArray = window.actividadesA;
    

    // Función para agregar actividad a la lista y valor al array
    $("#agregar-actividad").click(function() {
        var actividadText = $("#actividades option:selected").text();
        var actividadValue = $("#actividades").val();
        var valueInt = parseInt(actividadValue);
        if (actividadValue !== "") {
            //console.log("BUENOS DIAS");
            actividadesArray.push(valueInt); // Agrega el valor al array
            //$("#actividades-agregadas").append("<li>" + actividadText + " <button type='button' class='btn btn-danger btn-circle btn-sm eliminar-actividad'>S</button></li>");
            $("#actividades-agregadas").append("<li>" + actividadText + " <i class='eliminar-actividad fas fa-trash-alt'></i></li>");
            console.log(actividadesArray);
            $("#actividades").val($("#actividades option:first").val()); // Establece el valor del select en el índice 0
        }
    });
    $(document).on("click", ".eliminar-actividad", function() {
        var index = $(this).parent().index(); // Obtiene el índice del elemento a eliminar
        actividadesArray.splice(index, 1); // Elimina el valor del array
        $(this).parent().remove(); // Elimina la actividad de la lista
        console.log(actividadesArray);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById("enviar-formulario").addEventListener("click", function() {
        //console.log("First Step");
        var idc = document.getElementById("id_solicitud").value
        var id = parseInt(idc);
        var area = document.getElementById("selectHabitaciones").value;
        var prioridad = document.getElementById("prioridad").value;
        var fecha = document.getElementById("fecha").value;
        var hora = document.getElementById("hora").value;
        var instrucciones = document.getElementById("instrucciones").value;

        /*console.log(area);
        console.log(prioridad);
        console.log(fecha);
        console.log(hora);
        console.log(instrucciones);
        console.log(actividadesArray);*/
        console.log('STARTING...');

        /*console.log(typeof area);
        console.log("area");*/


        const UpdateSolicitud = new Solicitud(id, area, prioridad, 'pendiente', fecha, hora, instrucciones, actividadesArray);
        UpdateSolicitud.showlog();
        
        // Llamamos al método enviarSolicitud del objeto Solicitud
        UpdateSolicitud.enviarSolicitud("modificar.php", function(error, respuesta) {
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
        window.location.href = 'ConsultarSolicitudesJ.php';
    }, 5000);
}
