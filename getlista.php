<?php
require_once 'ConexionDB.php';

// Obtener el nombre de la tabla de la solicitud GET
$nombreTabla = $_GET['tabla'];

// Crear una instancia de la clase ConexionDB
$db = new ConexionDB();

// Conectar a la base de datos
$db->conectar();

// Consultar la tabla especificada
$resultado = $db->consultar("SELECT * FROM areas JOIN $nombreTabla USING (id_area)");

// Verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    // Inicializar un array para almacenar los datos
    $data = array();

    // Iterar sobre los resultados y almacenarlos en el array
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }

    // Devolver los datos en formato JSON
    echo json_encode($data);
} else {
    // Si no se encontraron resultados, devolver un mensaje de error
    echo json_encode(array('mensaje' => 'No se encontraron datos en la tabla'));
}

// Cerrar la conexión a la base de datos
$db->cerrarConexion();
?>
