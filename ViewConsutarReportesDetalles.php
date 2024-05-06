<?php 
    session_start();
    if (!isset($_SESSION['usuario']) || $_SESSION['puesto'] !== 'Jefe de Conserjeria') {
        header("Location: login.html");
        exit();
    }
    $usuario = $_SESSION['usuario'];

    include "ConexionDB.php";
    $id_reporte=$_GET['id'];
    $Mylink = new ConexionDB();
    $myconsulta = "SELECT * FROM reporte JOIN nombrecompleto ON reporte.id_conserje = nombrecompleto.id_empleado JOIN areahabitacion USING(id_area) WHERE id_reporte = '$id_reporte'";
    $sql = $Mylink->consultar($myconsulta);
    $datos = $sql->fetch_object();
    $id_area = $datos->id_area;
    $myconsulta = "SELECT * FROM habitacion WHERE id_area = '$id_area'";
    $sql2 = $Mylink->consultar($myconsulta);
    //echo $myconsula2;
    if(mysqli_num_rows($sql2) === 0){
        $tipoArea = "Area Comun";
    }else{
        $tipoArea = "Habitacion";
    }
    //$myconsula2 = "SELECT * FROM areahabitacion WHERE id_area = '$id_area'";
    //$sql3 = $Mylink->consultar($myconsula2);
    //$areahab = $sql3->fetch_object();
    $consultaEmpleado = "SELECT nombre, apellido_paterno, apellido_materno FROM empleado WHERE id_empleado='$usuario'";
    $resultadoEmpleado = $Mylink->consultar($consultaEmpleado);
    // Obtener el nombre completo del empleado
    $nombreCompleto = "";
    if ($resultadoEmpleado->num_rows > 0) {
        $filaEmpleado = $resultadoEmpleado->fetch_assoc();
        $nombreCompleto = $filaEmpleado['nombre'] . ' ' . $filaEmpleado['apellido_paterno'] . ' ' . $filaEmpleado['apellido_materno'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reporte Detalles</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexJefe.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hotel"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hotel Clean</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="indexJefe.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Solicitudes</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="ConsultarSolicitudesJ.php">Consultar Solicitud</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reportes</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item active" href="ViewConsultarReportes.php">Consultar Reportes</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <span class="nav-item">
                        <span class="nav-link" style="color: #000000; font-weight: bold;">
                            <?php echo "Fecha: ". date('d-m-Y'); ?>
                        </span>
                    </span>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombreCompleto ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid pt-3">

                    <!-- Page Heading
                    <h1 class="h3 mb-1 text-gray-800">Color Utilities</h1>-->

                    <!-- Content Row -->
                    <div class="row align-items-center justify-content-center">

                        <div class="col-xl-8 col-lg-8">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DETALLES</h6>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div>
                                            <h5 class="text-center">Formulario de Solicitud</h5>
                                            <form id="formulario-limpieza">
                                                <!--Select: TIPO AREA-->
                                                <div class="form-group">
                                                    <!--Select: TIPO AREA-->
                                                    <div class="form-group">
                                                        <label for="id-reporte">ID Reporte:</label>
                                                        <input type="text" class="form-control" id="id-reporte" name="id-reporte" value="<?php echo $datos->id_reporte?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id-reporte">Conserje Remitente:</label>
                                                    <input type="text" class="form-control" id="nom_conserje" name="nom_conserje" value="<?php echo $datos->nomcompleto?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <!--Select: TIPO AREA-->
                                                    <div class="form-group">
                                                        <label for="typearea">Tipo de Area:</label>
                                                        <input type="text" class="form-control" id="typearea" name="typearea" value="<?php echo $tipoArea?>" readonly>
                                                    </div>
                                                </div>
                                                <!--Select: AREA HABITACION-->
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="area">Area/Habitacion:</label>
                                                        <input type="text" class="form-control" id="area" name="area" value="<?php echo $datos->area_habitacion?>" readonly>
                                                    </div>
                                                </div>
                                                <!--Select: NIVEL DE PRIORIDAD-->
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="typereport">Tipo de Reporte:</label>
                                                        <input type="text" class="form-control" id="typereport" name="typereport" value="<?php echo $datos->tipo?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <table class="w-100">
                                                        <tr>
                                                            <td><label for="fecha">Fecha:</label></td>
                                                            <td><label for="hora">Hora:</label></td>
                                                            <!--<td><input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" required></td>-->
                                                        </tr>
                                                        <tr>
                                                            <!--<td><label for="hora_solicitud">Hora de Solicitud:</label></td>-->
                                                            <td><input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $datos->fecha?>" readonly></td>
                                                            <td><input type="time" class="form-control" id="hora" name="hora"value="<?php echo $datos->hora?>"  readonly></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion">Descripcion:</label>
                                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" readonly><?php echo $datos->detalles?></textarea>
                                                </div>
                                                <a class="btn btn-info btn-block" href="ViewConsultarReportes.php">Regresar</a>
                                                

                                                <!--<div class="form-group">
                                                    <label for="nombre">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellido:</label>
                                                    <input type="text" class="form-control" id="apellido" name="apellido">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>-->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Third Column
                        <div class="col-lg-4">
                        </div>-->

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="clases.js" defer></script>

</body>

</html>