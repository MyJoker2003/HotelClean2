<?php
// Incluimos la clase ConexionBD.php
require_once('ConexionDB.php');

// Creamos una instancia de la clase ConexionBD
$conexionBD = new ConexionDB();

// Recibimos los datos enviados por la personal$personal POST
$data = file_get_contents("php://input");

// Convertimos los datos JSON a un array asociativo
$personal = json_decode($data, true);

// Almacenamos los atributos en variables

$id_solicitud = $personal['id_solicitud'];
$id_solnum = intval($id_solicitud);
$conserjes = isset($personal['conserjes']) ? $personal['conserjes'] : []; // Verificamos si se proporciona el array de actividades

$flag = true;

if(!empty($conserjes)){
    foreach ($conserjes as $conserje) {
        $consulta = "INSERT INTO solicitudconserje (id_solicitud,id_conserje) VALUES ($id_solnum,'$conserje')";
        $resultado = $conexionBD->consultar($consulta);
        if(!$resultado){
            $flag = false;
        }
           
    }
    if($flag){
        echo "El personal ha sido asignado EXITOSAMENTE";
    }else{
        echo "Hubo un error al procesar la personal";
    }    
}else{
    echo "ERROR Lista Vacia";
}
$conexionBD->cerrarConexion();
?>
