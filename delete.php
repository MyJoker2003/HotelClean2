<?php
// Verifica si se ha enviado el ID de la solicitud
if(isset($_POST['id_solicitud'])) {
    // Incluye el archivo de conexión
    include "ConexionDB.php";
    
    // Crea una instancia de la clase de conexión
    $Mylink = new ConexionDB();
    
    // Sanitiza el ID de la solicitud para evitar inyección de SQL
    $id_solicitud = $_POST['id_solicitud'];
    
    // Query para eliminar los registros relacionados en la tabla solicitud_conserje
    $query_eliminar_solicitud_conserje = "DELETE FROM solicitudconserje WHERE id_solicitud = $id_solicitud";
    $resultado_eliminar_solicitud_conserje = $Mylink->consultar($query_eliminar_solicitud_conserje);
    
    // Query para eliminar los registros relacionados en la tabla solicitudactividades
    $query_eliminar_solicitud_actividades = "DELETE FROM solicitudactividades WHERE id_solicitud = $id_solicitud";
    $resultado_eliminar_solicitud_actividades = $Mylink->consultar($query_eliminar_solicitud_actividades);
    
    // Query para eliminar la solicitud principal de la tabla solicitud
    $query_eliminar_solicitud = "DELETE FROM solicitud WHERE id_solicitud = $id_solicitud";
    $resultado_eliminar_solicitud = $Mylink->consultar($query_eliminar_solicitud);
    
    // Verifica si la eliminación de la solicitud principal fue exitosa
    if($resultado_eliminar_solicitud) {
        // Si la eliminación fue exitosa, devuelve una respuesta exitosa
        echo json_encode(array("success" => true));
    } else {
        // Si ocurrió un error, devuelve un mensaje de error
        echo json_encode(array("success" => false, "message" => "Error al eliminar la solicitud"));
    }
    
    // Cierra la conexión
    $Mylink->cerrarConexion();
} else {
    // Si no se envió el ID de la solicitud, devuelve un mensaje de error
    echo json_encode(array("success" => false, "message" => "ID de solicitud no proporcionado"));
}
?>
