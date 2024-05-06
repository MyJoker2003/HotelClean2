<?php
// Incluimos la clase ConexionBD.php
require_once('ConexionDB.php');

// Creamos una instancia de la clase ConexionBD
$conexionBD = new ConexionDB();

// Consulta para obtener el último ID ingresado en la tabla
$consultaUltimoID = "SELECT MAX(id_solicitud) AS ultimo_id FROM solicitud";
$resultadoUltimoID = $conexionBD->consultar($consultaUltimoID);

/*// Verificamos si se obtuvo el último ID correctamente
if ($resultadoUltimoID) {
    $filaUltimoID = $conexionBD->obtenerFila($resultadoUltimoID);
    $ultimoID = $filaUltimoID['ultimo_id'];

    // Incrementamos el último ID para obtener el nuevo ID de la solicitud
    $nuevoID = $ultimoID + 1;
} else {
    // En caso de error, asignamos un valor predeterminado para el nuevo ID
    $nuevoID = 1;
}*/

// Verificamos si se obtuvo el último ID correctamente
if ($resultadoUltimoID) {
    // Obtenemos la fila de resultados como un array asociativo
    $filaUltimoID = $resultadoUltimoID->fetch_assoc();

    if ($filaUltimoID && isset($filaUltimoID['ultimo_id'])) {
        $ultimoID = $filaUltimoID['ultimo_id'];
        // Incrementamos el último ID para obtener el nuevo ID de la solicitud
        $nuevoID = $ultimoID + 1;
    } else {
        // En caso de que no se encuentre ningún ID en la tabla, asignamos un valor predeterminado para el nuevo ID
        $nuevoID = 1;
    }
} else {
    // En caso de error, asignamos un valor predeterminado para el nuevo ID
    $nuevoID = 1;
}


// Recibimos los datos enviados por la solicitud POST
$data = file_get_contents("php://input");

// Convertimos los datos JSON a un array asociativo
$solicitud = json_decode($data, true);

// Almacenamos los atributos en variables
$id_solicitud = $nuevoID; // Utilizamos el nuevo ID calculado
$id_area = $solicitud['id_area'];
$prioridad = $solicitud['prioridad'];
$estado = $solicitud['estado'];
$fecha = $solicitud['fecha'];
$hora = $solicitud['hora'];
$instrucciones = $solicitud['instrucciones'];
$actividades = isset($solicitud['actividades']) ? $solicitud['actividades'] : []; // Verificamos si se proporciona el array de actividades

// Construimos la consulta SQL para insertar los datos en la tabla de solicitudes
$consultaSolicitud = "INSERT INTO solicitud (id_solicitud, id_area, prioridad, estado, fecha, hora, instrucciones) 
                      VALUES ($id_solicitud, '$id_area', '$prioridad', '$estado', '$fecha', '$hora', '$instrucciones')";

// Ejecutamos la consulta para insertar la solicitud utilizando el método consulta de la clase ConexionBD
$resultadoSolicitud = $conexionBD->consultar($consultaSolicitud);

// Verificamos si la consulta de solicitud fue exitosa
if ($resultadoSolicitud) {
    // Si se proporciona el array de actividades, también lo insertamos en la tabla de actividades
    if (!empty($actividades)) {
        foreach ($actividades as $actividad) {
            // Construimos la consulta SQL para insertar cada actividad en la tabla de actividades
            $consultaActividad = "INSERT INTO solicitudactividades (id_solicitud, id_actividad) 
                                  VALUES ($id_solicitud, $actividad)";
            // Ejecutamos la consulta para insertar la actividad utilizando el método consulta de la clase ConexionBD
            $conexionBD->consultar($consultaActividad);
        }
    }
    echo "La solicitud se ha procesado exitosamente.";
} else {
    echo "Hubo un error al procesar la solicitud.";
}
$conexionBD->cerrarConexion();
?>
