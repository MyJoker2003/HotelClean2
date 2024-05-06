document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById("report-content").addEventListener("click", function() {
        //console.log("First Step");
        var user = document.getElementById("id-conserje").value;
        var area = document.getElementById("selectHabitaciones").value;
        var tipo = document.getElementById("typereport").value;
        var fecha = document.getElementById("fecha").value;
        var hora = document.getElementById("hora").value;
        var descripcion = document.getElementById("descripcion").value;

        console.log(user)
        console.log(area);
        console.log(tipo);
        console.log(fecha);
        console.log(hora);
        console.log(descripcion);
        console.log('STARTING...');

        /*console.log(typeof area);
        console.log("area");*/

        const nuevoReporte =  new reporte(0,user,area,tipo,fecha,hora,descripcion);
        nuevoReporte.showData();
        
        nuevoReporte.registrarReporte("savereport.php", function(error, respuesta) {
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
