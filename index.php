<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: vistas/login.php");
  exit();
}

$rol = $_SESSION['rol'];
if ($rol == 'trabajador') {
  header("Location: vistas/registros_aviones.php");
} elseif ($rol == 'comandante') {
  header("Location: vistas/dashboard_comandante.php");
}
?>
