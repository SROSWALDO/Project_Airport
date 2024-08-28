<?php
include '../includes/funciones.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  $user = iniciarSesion($usuario, $contrasena);
  if ($user) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['rol'];
    header("Location: ../index.php");
    exit();
  } else {
    $error = "Usuario o contraseña incorrectos";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link href="../styles.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Login</title>
  
</head>
<body style="background-image:url('../images/aeroWall.jpg'); background-size: cover; font-family: Poppins " class="w-full h-[100vh]  bg-cover bg-center flex " >
  <form style=" background-color: rgb(255 255 255 / 0.8);" class="w-[500px] h-[500px] bg-white/70 m-auto items-center p-6 rounded-lg flex flex-col justify-center relative  shadow-xl" method="POST">
  <img style=" width: 200px; position: absolute; top: 5px; "  src="../images/omapng.png" alt="logo">
    <h2 class=" font-semibold text-3xl text-center " >Iniciar Sesión</h2>
    <input class="text-gray-800 bg-white border border-gray-300 w-[350px] text-sm px-4 py-2.5 rounded-md outline-blue-500 mb-2 mt-9 " type="text" name="usuario" placeholder="Usuario" required>
    <input class="text-gray-800 bg-white border border-gray-300 w-[350px] text-sm px-4 py-2.5 rounded-md outline-blue-500" type="password" name="contrasena" placeholder="Password" required>
    <div class="forgot-password">
      <a href="#"></a>
      
    </div>
    <button type="submit" class=" bg-blue-950 text-white w-[230px] p-2 rounded mt-5 hover:bg-blue-900 " >Iniciar</button>
    
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
  </form>
</body>
</html>