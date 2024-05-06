<?php
include 'ConexionDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $conexionDB = new ConexionDB();
    $consulta = "SELECT puesto FROM empleado WHERE id_empleado='$usuario' AND thepassword='$contrasena'";
    $resultado = $conexionDB->consultar($consulta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $puesto = $fila['puesto'];
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['puesto'] = $puesto;
        
        // Envía una respuesta JSON con éxito y la URL de redirección
        echo json_encode(array('success' => true, 'redirect' => obtenerURLPorPuesto($puesto)));
    } else {
        // Envía una respuesta JSON con error
        echo json_encode(array('success' => false, 'message' => 'Usuario o contraseña incorrectos'));
    }

    $conexionDB->cerrarConexion();
}

function obtenerURLPorPuesto($puesto) {
    switch ($puesto) {
        case 'Recepcionista':
            //return 'indexRecepcionista.php';
            return 'indexRecepcionista1.php';
        case 'Conserje':
            return 'indexConserje.php';
        case 'Jefe de Conserjeria':
            return 'indexJefe.php';
        default:
            return 'index.php'; // Página por defecto si el puesto no está reconocido
    }
}
?>
