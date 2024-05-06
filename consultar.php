<?php
// consultardb.php

// Incluir la clase ConexionDB
include 'ConexionDB.php';

// Crear una instancia de la clase ConexionDB
$conexionDB = new ConexionDB();

// Obtener el nombre de la tabla desde la solicitud GET
$nombreTabla = $_GET['tabla'];

// Consultar la base de datos
$resultado = $conexionDB->consultar("SELECT * FROM areas JOIN $nombreTabla USING(id_area)");

// Crear un array para almacenar los resultados
$habitaciones = [];

// Convertir los resultados en un array asociativo
while ($row = $resultado->fetch_assoc()) {
    $habitaciones[] = $row;
}

// Devolver los resultados en formato JSON
echo json_encode($habitaciones);

// Cerrar la conexión a la base de datos (si es necesario)
$conexionDB->cerrarConexion();
?>
