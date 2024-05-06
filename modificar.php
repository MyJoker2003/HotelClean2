<?php
// Incluimos la clase ConexionBD.php
require_once('ConexionDB.php');

// Creamos una instancia de la clase ConexionBD
$conexionBD = new ConexionDB();

// Recibimos los datos enviados por la solicitud POST
$data = file_get_contents("php://input");

// Convertimos los datos JSON a un array asociativo
$modificacion = json_decode($data, true);

// Almacenamos los atributos en variables
$id_solicitud = $modificacion['id_solicitud']; // Utilizamos el nuevo ID calculado
$id_area = $modificacion['id_area'];
$prioridad = $modificacion['prioridad'];
$estado = $modificacion['estado'];
$fecha = $modificacion['fecha'];
$hora = $modificacion['hora'];
$instrucciones = $modificacion['instrucciones'];
$actividades = isset($modificacion['actividades']) ? $modificacion['actividades'] : []; // Verificamos si se proporciona el array de actividades

if(!empty($actividades)){
    $sqlstmt = "DELETE FROM solicitudactividades WHERE id_solicitud = $id_solicitud";
    $resultado1 = $conexionBD->consultar($sqlstmt);

    if($resultado1){
        foreach ($actividades as $actividad) {
            // Construimos la consulta SQL para insertar cada actividad en la tabla de actividades
            $consultaActividad = "INSERT INTO solicitudactividades (id_solicitud, id_actividad) 
                                  VALUES ($id_solicitud, $actividad)";
            // Ejecutamos la consulta para insertar la actividad utilizando el método consulta de la clase ConexionBD
            $resin = $conexionBD->consultar($consultaActividad);
            if(!$resin){
                echo "ERROR #3";
            }
        }
    }else{
        echo "ERORR 2";
    }

    $sqlstmt = "UPDATE solicitud SET id_area = '$id_area', prioridad = '$prioridad', fecha = '$fecha', hora = '$hora', instrucciones = '$instrucciones' WHERE id_solicitud = $id_solicitud";
    $resfin = $conexionBD->consultar($sqlstmt);
    if($resfin){
        echo "La Solicitud se ha modificaco exitosamente";
    }else{
        echo "Minimo el error esta en la consulta";
    }
}else{
    echo "ERROR 1";
}

$conexionBD->cerrarConexion();
?>