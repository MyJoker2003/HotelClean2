<?php
// Incluimos la clase ConexionBD.php
require_once('ConexionDB.php');

// Creamos una instancia de la clase ConexionBD
$conexionBD = new ConexionDB();

// Recibimos los datos enviados por la solicitud POST
$data = file_get_contents("php://input");

// Convertimos los datos JSON a un array asociativo
$reporte = json_decode($data, true);

// Almacenamos los atributos en variables
$id_conserje = $reporte['id_conserje'];
$id_area = $reporte['id_area'];
$tipo = $reporte['tipo'];
$fecha = $reporte['fecha'];
$hora = $reporte['hora'];
$desc = $reporte['desc'];
/*$id_solicitud = $nuevoID; // Utilizamos el nuevo ID calculado
$id_area = $solicitud['id_area'];
$prioridad = $solicitud['prioridad'];
$estado = $solicitud['estado'];
$fecha = $solicitud['fecha'];
$hora = $solicitud['hora'];
$instrucciones = $solicitud['instrucciones'];
$actividades = isset($solicitud['actividades']) ? $solicitud['actividades'] : []; // Verificamos si se proporciona el array de actividades
*/
// Construimos la consulta SQL para insertar los datos en la tabla de solicitudes
$consultaSolicitud = "INSERT INTO reporte (id_area, id_conserje, fecha, hora, tipo, detalles) 
                      VALUES ('$id_area', '$id_conserje', '$fecha', '$hora', '$tipo', '$desc')";

// Ejecutamos la consulta para insertar la solicitud utilizando el método consulta de la clase ConexionBD
$resultadoSolicitud = $conexionBD->consultar($consultaSolicitud);

// Verificamos si la consulta de solicitud fue exitosa
if ($resultadoSolicitud) {
    echo "La solicitud se ha procesado exitosamente.";
} else {
    echo "Hubo un error al procesar la solicitud.";
}
$conexionBD->cerrarConexion();
?>
