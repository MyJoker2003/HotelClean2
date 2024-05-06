class Solicitud {
    constructor(id_solicitud, id_area, prioridad, estado, fecha, hora, instrucciones, actividades) {
        this.id_solicitud = id_solicitud;
        this.id_area = id_area;
        this.prioridad = prioridad;
        this.estado = estado;
        this.fecha = fecha;
        this.hora = hora;
        this.instrucciones = instrucciones;
        this.actividades = actividades || []; // Si no se proporciona un array de actividades, se crea un array vacío por defecto
    }

    // Métodos para acceder y modificar atributos

    showlog(){
        console.log("Solicitud:"+this.id_solicitud);
        console.log("Area:"+this.id_area+"->"+typeof(this.id_area));
        console.log("Prioridad:"+this.prioridad+"->"+typeof(this.prioridad));
        console.log("Estado:"+this.estado+"->"+typeof(this.estado));
        console.log("Fecha:"+this.fecha+"->"+typeof(this.fecha));
        console.log("Hora:"+this.hora+"->"+typeof(this.hora));
        console.log("Inst:"+this.instrucciones+"->"+typeof(this.instrucciones));
        console.log(this.actividades);
    }
    

    enviarSolicitud(url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    callback(null, xhr.responseText);
                } else {
                    callback("Hubo un error al procesar la solicitud.", null);
                }
            }
        };
        var datosJSON = JSON.stringify(this);
        xhr.send(datosJSON);
    }
}

// Ejemplo de uso
/*const solicitud1 = new Solicitud(1, 100, 'Alta', 'Pendiente', '2024-04-21', '10:00', 'Realizar mantenimiento', ['Actividad 1', 'Actividad 2']);
console.log(solicitud1);

// Agregar una nueva actividad
solicitud1.agregarActividad('Actividad 3');
console.log(solicitud1.obtenerActividades()); // Salida: ['Actividad 1', 'Actividad 2', 'Actividad 3']*/


