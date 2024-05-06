<?php
// Incluimos la clase ConexionBD.php
require_once('ConexionDB.php');

// Creamos una instancia de la clase ConexionBD
$conexionBD = new ConexionDB();

// Obtener los datos enviados por Ajax
$datosJSON = file_get_contents('php://input');

// Decodificar los datos JSON en un objeto stdClass de PHP
$datos = json_decode($datosJSON);

// Acceder a los atributos de la instancia de la clase
$id_sol = $datos->id_solicitud;
$id_solicitud = intval($id_sol);
$arrayConsumibles = $datos->arrayConsumibles;
$arrayNoConsumibles = $datos->arrayNoConsumibles;

$flag = true;
//$msg = "CCC";

if(!empty($arrayConsumibles) && !empty($arrayNoConsumibles) ){
    foreach($arrayNoConsumibles as $Noconsumibles){
        $consulta = "INSERT INTO noconsumiblesolicitud (id_solicitud,id_utensilio) VALUES ($id_solicitud,'$Noconsumibles')";
        $resultado = $conexionBD->consultar($consulta);
        if(!$resultado){
            $flag = false;
        }
    }
    foreach($arrayConsumibles as $consumibles){
        $id = $consumibles->id_utensilio;
        $cantidad = $consumibles->cantidad;
        $consulta = "INSERT INTO consumiblesolicitud (id_solicitud,id_utensilio,cantidad) VALUES($id_solicitud,'$id',$cantidad)";
        $resultado = $conexionBD->consultar($consulta);
        if(!$resultado){
            $flag = false;
        }
    }
    //echo "AMBOS LLENOS";
}else if(!empty($arrayConsumibles)){
    //$msg = "EXITO";
    foreach($arrayConsumibles as $consumibles){
        $id = $consumibles->id_utensilio;
        $cantidad = $consumibles->cantidad;
        $consulta = "INSERT INTO consumiblesolicitud (id_solicitud,id_utensilio,cantidad) VALUES($id_solicitud,'$id',$cantidad)";
        $resultado = $conexionBD->consultar($consulta);
        if(!$resultado){
            //$msg = "Algo mal en la Cosulta";
            $flag = false;
        }
        //$msg = print_r($consumibles,true);
        //$msg = $consulta;
    }
    //echo $msg;
    //echo "No Consumible Vacio";
}else{
    foreach($arrayNoConsumibles as $Noconsumibles){
        $consulta = "INSERT INTO noconsumiblesolicitud (id_solicitud,id_utensilio) VALUES ($id_solicitud,'$Noconsumibles')";
        $resultado = $conexionBD->consultar($consulta);
        if(!$resultado){
            $flag = false;
        }
    }
    echo "Consumible Vacio";
}
$consulta = "UPDATE solicitud SET estado = 'Completado' WHERE id_solicitud = $id_solicitud";
        $resultado = $conexionBD->consultar($consulta);
if(!$resultado){$flag = false;}
if($flag){
    echo "ALL IS FINE";
}else{
    echo "ALL FAILURE";
}
$conexionBD->cerrarConexion();
?>