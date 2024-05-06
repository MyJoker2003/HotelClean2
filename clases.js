//Definicion de la clase Area
class Area {
    constructor(id,piso,nombre){
        this.id = id;
        this.piso = piso
        this.nombre =nombre
    }

    getvalue(){
        return this.nombre;
    }

    toString(){
        return `MiClase: ${this.id} , ${this.piso},${this.nombre}`;
    }
    
}

//Definicion de la clase Habitacion
class Habitacion {
    constructor(id, piso,numero){
        this.id = id;
        this.piso = piso
        this.numero = numero
    }

    getvalue(){
        return  this.numero
    }

    toString(){
        return `MiClase: ${this.id} , ${this.piso},${this.numero}`;
    }
}

// Definición de la clase ListaAreas
class ListaAreas{
    constructor(){
        this.lista = []; //Array para almacenar las áreas
    }

    async fillLista(nombreTabla){
        try{
            //Realizar la consulta a la base de datos
            const response = await fetch('consultar.php?tabla=' + nombreTabla);
            const data = await response.json();

            // Iterar sobre los datos recibidos y crear objetos de clase Habitacion
            data.forEach(row => {
                if(nombreTabla === "areacomun"){
                    const areacomun = new Area(row.id_area,row.piso,row.nombre);
                    this.lista.push(areacomun)
                }else{
                    const habitacion = new Habitacion(row.id_area, row.piso, row.numero);
                    this.lista.push(habitacion); // Agregar la habitación a la lista
                }
            });
            console.log('Habitaciones agregadas correctamente.');
            if (this.lista.length > 0) {
                console.log('Datos Recibidos');
                this.lista.forEach(elemento => {
                    console.log(elemento.toString());
                });
            } else {
                console.log('PROBLEMAS AGAIN');
            }
            console.log(this.lista.length);

            return this.lista; // Devolver el arreglo lista después de llenarlo
        } catch(error){
            console.error('Error al consultar y agregar habitaciones:', error);
            return []; // Devolver un arreglo vacío en caso de erro
        }
    }

    async llenarLista(nombreTabla){
        try {
            // Realizar la consulta a la base de datos
            const response = await fetch('consultar.php?tabla=' + nombreTabla);
            const data = await response.json();

            // Iterar sobre los datos recibidos y crear objetos de clase Habitacion
            data.forEach(row => {
                const habitacion = new Habitacion(row.id_area, row.piso, row.numero);
                this.lista.push(habitacion); // Agregar la habitación a la lista
            });

            console.log('Habitaciones agregadas correctamente.');
            if(this.lista.length > 0){
                console.log('Datos Recibidos')
                this.lista.forEach(elemento =>{
                    console.log(elemento.toString());
                })
            }else {console.log('PROBLEMAS AGAIN')}
        } catch (error) {
            console.error('Error al consultar y agregar habitaciones:', error);
        }   
    }

    async llenarLista2(nombreTabla){
        try {
            // Realizar la consulta a la base de datos
            const response = await fetch('consultar.php?tabla=' + nombreTabla);
            const data = await response.json();

            // Iterar sobre los datos recibidos y crear objetos de clase Habitacion
            data.forEach(row => {
                const habitacion = new Habitacion(row.id_area, row.piso, row.numero);
                this.lista.push(habitacion); // Agregar la habitación a la lista
            });

            console.log('Habitaciones agregadas correctamente.');
            if(this.lista.length > 0){
                console.log('Datos Recibidos')
                this.lista.forEach(elemento =>{
                    console.log(elemento.toString());
                })
            }else {console.log('PROBLEMAS AGAIN')}
            console.log(this.lista.length);
        } catch (error) {
            console.error('Error al consultar y agregar habitaciones:', error);
        }   
    }

    show_Lista(){
        console.log('La longitud es:'+this.lista.length);
    }
}

class reporte{
    constructor(id_reporte,id_conserje,id_area,tipo,fecha,hora,desc){
        this.id_reporte = id_reporte;
        this.id_conserje = id_conserje;
        this.id_area = id_area;
        this.tipo = tipo;
        this.fecha = fecha;
        this.hora = hora;
        this.desc = desc;
    }

    showData(){
        console.log("<<REPORTE>>");
        console.log("ID: "+this.id_reporte);
        console.log("User: "+this.id_conserje);
        console.log("Area: "+this.id_area);
        console.log("Tipo: "+this.tipo);
        console.log("Fecha: "+this.fecha);
        console.log("Hora: "+this.hora);
        console.log("Descripcion: "+this.desc);
    }

    registrarReporte(url, callback) {
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

class ListaConserjes{
    constructor(id_solicitud,conserjes){
        this.id_solicitud = id_solicitud;
        this.conserjes = conserjes;
    }

    showData(){
        console.log("ID: "+this.id_solicitud);
        console.log("PERSONAL ASIGNADO:");
        console.log(this.conserjes);
    }

    asignarPersonal(url, callback) {
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

class YConsumible{
    constructor(id_utensilio,cantidad){
        this.id_utensilio = id_utensilio;
        this.cantidad = cantidad;
    }

    showData(){
        console.log("PARADE");
        console.log(this.id_utensilio+"->"+this.cantidad);
    }
}

class ListadoUtensilios{
    constructor(id_solicitud,arrayConsumibles,arrayNoConsumibles){
        this.id_solicitud = id_solicitud;//Array de Cadenas
        this.arrayConsumibles = arrayConsumibles; //Array de Objetos
        this.arrayNoConsumibles = arrayNoConsumibles;
    }

    showData(){
        console.log(this.id_solicitud);
        console.log(this.arrayConsumibles);
        console.log(this.arrayNoConsumibles);
    }

    FinalizarSolicitud(url, callback) {
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