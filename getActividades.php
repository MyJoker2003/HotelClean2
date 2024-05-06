<?php
    // Incluir el archivo ConexionDB.php
    //include 'ConexionDB.php';

    // Crear una instancia de la clase ConexionDB
    //$conexionDB = new ConexionDB();

    // Consulta SQL para obtener las opciones
    $sql = "SELECT * FROM actividades";
    $resultado = $conexionDB->consultar($sql);

    // Generar las opciones del select
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo '<option value="' . $row["id_actividad"] . '">' . $row["nombre"] . '</option>';
        }
    } else {
        echo '<option value="">No hay opciones disponibles</option>';
    }

    // Cerrar conexión
    $conexionDB->cerrarConexion();
?>