<?php
    // Incluir el archivo ConexionDB.php
    /*include 'ConexionDB.php';

    // Crear una instancia de la clase ConexionDB
    $conexionDB = new ConexionDB();*/

    // Consulta SQL para obtener las opciones
    $sql1 = "SELECT * FROM mis_conserjes WHERE id_empleado NOT IN(SELECT id_conserje FROM solicitudconserje JOIN solicitud USING (id_solicitud) WHERE hora = '$datos->hora' AND fecha = '$datos->fecha')";
    //$sql1 = "SELECT id_empleado, CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) AS nombre_completo FROM conserjes JOIN empleado USING(id_empleado)";
    $resultado = $Mylink->consultar($sql1);

    // Generar las opciones del select
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo '<option value="' . $row["id_empleado"] . '">' . $row["nombre_completo"] . '</option>';
        }
    } else {
        echo '<option value="">No hay opciones disponibles</option>';
    }

    // Cerrar conexión
    $Mylink->cerrarConexion();
?>