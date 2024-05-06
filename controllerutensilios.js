$(document).ready(function() {
    // Array para almacenar los valores de las actividades
    window.Consumibles = [];
    window.NoConsumibles = [];

    // Función para agregar actividad a la lista y valor al array
    $("#add-noconsumible").click(function() {
        var NoconsumibleText = $("#noconsumibles option:selected").text();
        var NoconsumableValue = $("#codigo").val();

        if (NoconsumableValue !== "") {
            console.log(NoconsumableValue);
            console.log(NoconsumibleText);
            //console.log("BUENOS DIAS");
            NoConsumibles.push(NoconsumableValue); // Agrega el valor al array
            console.log(NoConsumibles);
            //$("#actividades-agregadas").append("<li>" + actividadText + " <button type='button' class='btn btn-danger btn-circle btn-sm eliminar-actividad'>S</button></li>");
            $("#noconsumibles-agregados").append("<li class='mb-2'><i class='fa-solid fa-broom mr-3'></i>" + NoconsumibleText +" "+NoconsumableValue+ " <i class='eliminar-noconsu fas fa-trash-alt btn-sm btn-danger'></i></li>");
            console.log(NoConsumibles);
            $("#noconsumibles").val($("#noconsumibles option:first").val()); // Establece el valor del select en el índice 0*/
        }else{
            console.log('Ingresa un codigo valido');
        }
    });
    $(document).on("click", ".eliminar-noconsu", function() {
        var index = $(this).parent().index(); // Obtiene el índice del elemento a eliminar
        NoConsumibles.splice(index, 1); // Elimina el valor del array
        $(this).parent().remove(); // Elimina la actividad de la lista
        console.log(NoConsumibles);
    });
    

    // Función para agregar actividad a la lista y valor al array
    $("#add-consumible").click(function() {
        var consumibleText = $("#consumibles option:selected").text();
        var consumableValue = $("#consumibles").val();
        var cantidad = $("#cantidad").val();
        if(cantidad !=="" && parseInt(cantidad)>0){
            const noCon = new YConsumible(consumableValue,cantidad);
            //console.log(noCon);
            Consumibles.push(noCon); 
            console.log(Consumibles);
            //Agrega el objeto al array
            $("#consumibles-agregados").append("<li class='mb-1'><i class='fa-solid fa-broom mr-3'></i>" + consumibleText +" X"+cantidad+"<i class='eliminar-consu fas fa-trash-alt btn-sm btn-danger ml-2'></i></li>");
            console.log(Consumibles);
            $("#consumibles").val($("#consumibles option:first").val()); // Establece el valor del select en el índice 0
            $("#cantidad").val("");
        }else{
            console.log("X");
        }
    });
    $(document).on("click", ".eliminar-consu", function() {
        var index = $(this).parent().index(); // Obtiene el índice del elemento a eliminar
        Consumibles.splice(index, 1); // Elimina el valor del array
        $(this).parent().remove(); // Elimina la actividad de la lista
        console.log(Consumibles);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById("modificar").addEventListener("click", function() {
        console.log("GRAMATIC");
        var id_sol = document.getElementById("id-solicitud").value
        var id_solicitud = parseInt(id_sol);

        console.log(id_solicitud);
        console.log(window.Consumibles);
        console.log(window.NoConsumibles);
        console.log('STARTING...');

        /*console.log(typeof area);
        console.log("area");*/

        const paquete = new ListadoUtensilios(id_solicitud,window.Consumibles,window.NoConsumibles);
        paquete.showData();
        /*const nuevaSolicitud = new Solicitud(0, area, prioridad, 'pendiente', fecha, hora, instrucciones, actividadesArray);
        nuevaSolicitud.showlog();*/
        
        // Llamamos al método enviarSolicitud del objeto Solicitud
        paquete.FinalizarSolicitud("finalizarSol.php", function(error, respuesta) {
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
    }, 30000);
}
