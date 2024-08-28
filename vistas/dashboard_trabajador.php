<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'trabajador') {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datos = [
    'fecha' => $_POST['fecha'],
    'hora' => $_POST['hora'],
    'matricula' => $_POST['matricula'],
    'equipo' => $_POST['equipo'],
    'comandante' => $_POST['comandante'],
    'licencia_comandante' => $_POST['licencia_comandante'],
    'sub_comandante' => $_POST['sub_comandante'],
    'licencia_sub_comandante' => $_POST['licencia_sub_comandante'],
    'num_pasajeros' => $_POST['num_pasajeros'],
  ];
  if (registrarAvion($datos)) {
    $mensaje = "Avión registrado con éxito";
  } else {
    $error = "Error al registrar el avión";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Trabajador</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="../styles.css" rel="stylesheet">
</head>
<body>
  <div style="font-family: Poppins " class="w-full h-[100vh] flex ">
    <div style="width: 1000px; padding: 1rem; " class="bg-white h-[500px]  shadow-xl border m-auto items-center p-4 " >
    <h2 class="text-center text-xl " >Registrar Avión</h2>
    <form style="margin-top:15px;" method="POST">
      <div class=" m-auto  flex justify-around  " style="margin:auto; margin-bottom:10px; " >
      <input style="width: 300px; " class=" text-center border border-gray-300 p-1 rounded " type="date" name="fecha" required>
      <input style="width: 300px; " class="text-center border border-gray-300 p-1 rounded" type="time" name="hora" required>
      </div>
      <input type="text" name="matricula" placeholder="Matrícula" required>
      <input type="text" name="equipo" placeholder="Equipo" required>
      <input type="text" name="comandante" placeholder="Comandante" required>
      <input type="text" name="licencia_comandante" placeholder="Licencia Comandante" required>
      <input type="text" name="sub_comandante" placeholder="Sub Comandante">
      <input type="text" name="licencia_sub_comandante" placeholder="Licencia Sub Comandante">
      <input type="number" name="num_pasajeros" placeholder="Número de Pasajeros" required>
      <button type="submit">Registrar</button>
    </form>
    <?php if (isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    
    <!-- <div class="botones-nav">
      <a href="registros_aviones.php" class="btn">Registros</a>
      <a href="../logout.php" class="btn">Cerrar Sesión</a>
    </div> -->
    </div>
  </div>
</body>
</html>


