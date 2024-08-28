<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'trabajador') {
    header("Location: ../vistas/login.php");
    exit();
}

include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comandante = $_POST['comandante'];
  $sub_comandante = $_POST['sub_comandante'];
  $matricula = $_POST['matricula'];
  $equipo = $_POST['equipo'];

  // Validar que solo se ingresen letras en comandante y sub_comandante
  if (!ctype_alpha(str_replace(' ', '', $comandante))) {
      $error = "El nombre del comandante solo debe contener letras.";
  } elseif (!ctype_alpha(str_replace(' ', '', $sub_comandante))) {
      $error = "El nombre del subcomandante solo debe contener letras.";
  } elseif (preg_match('/[^a-zA-Z0-9]/', $matricula)) {
      // Validar que la matrícula no contenga caracteres especiales
      $error = "La matrícula no debe contener caracteres especiales.";
  } elseif (preg_match('/[^a-zA-Z0-9-]/', $equipo)) {
      // Validar que el equipo no contenga caracteres especiales
      $error = "El equipo no debe contener caracteres especiales.";
  } else {
      $datos = [
          'fecha' => $_POST['fecha'],
          'hora' => $_POST['hora'],
          'matricula' => $matricula,
          'equipo' => $equipo,
          'comandante' => $comandante,
          'licencia_comandante' => $_POST['licencia_comandante'],
          'sub_comandante' => $sub_comandante,
          'licencia_sub_comandante' => $_POST['licencia_sub_comandante'],
          'num_pasajeros' => $_POST['num_pasajeros'],
      ];
      if (registrarAvion($datos)) {
          $mensaje = "Avión registrado con éxito";
      } else {
          $error = "Error al registrar el avión";
      }
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Avión</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding-top: 110px; /* Espacio para el navbar */
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px 25px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .avatar img {
            border-radius: 50%;
            width: 50px;
        }
        .navbar .botones-nav {
            background-color: #165edf;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
        }
        .navbar .logout {
            display: flex;
            align-items: center;
            background-color: red;
            color: white;
            padding: 7px 14px;
            border-radius: 8px;
            margin-right: 35px;
            text-decoration:none;
        }
        .navbar .logout img {
            margin-left: 10px;
            width: 20px;
        }
        .container {
            background-color: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 0 auto; /* Centrar el contenedor */
        }
        .container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 24px;
        }
        .form-group {
            position: relative;
            margin-bottom: 15px;
            flex: 1;
        }
        .form-group input {
            width: 93%;
            padding: 10px 13px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f7f8fa;
        }
        .form-group input:focus {
            outline: none;
            border-color: #165edf;
            background-color: #fff;
        }
        .form-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #999;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: 0;
            left: 10px;
            font-size: 12px;
            color: #165edf;
            background: #fff;
            padding: 0 5px;
        }
        .form-row {
            display: flex;
            gap: 10px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #165edf;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #3700b3;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }
        .message.success {
            color: #28a745;
        }
        .message.error {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="avatar">
        <img src="../images/omanav.jpg" alt="">
       
    </div>
    <a href="registros_aviones.php" class="botones-nav">Ver registros</a>
    <div class="logout">
        <a style="text-decoration:none; color:white; "  href="../logout.php">Cerrar Sesión</a>
        <img src="../images/exit.svg" alt="">
    </div>
</div>

<div class="container">
<?php if (isset($mensaje)) { echo "<p class='message success'>$mensaje</p>"; } ?>
<?php if (isset($error)) { echo "<p class='message error'>$error</p>"; } ?>
    <h2>Registrar Avión</h2>
    <form method="POST">
        <div class="form-group">
            <input type="date" name="fecha" value="<?= isset($_POST['fecha']) ? $_POST['fecha'] : '' ?>" required>
            <label>Fecha</label>
        </div>
        <div class="form-group">
            <input type="time" name="hora" value="<?= isset($_POST['hora']) ? $_POST['hora'] : '' ?>" required>
            <label>Hora</label>
        </div>
        <div class="form-group">
            <input type="number" name="num_pasajeros" value="<?= isset($_POST['num_pasajeros']) ? $_POST['num_pasajeros'] : '' ?>" placeholder=" " required>
            <label>Número de Pasajeros</label>
        </div>
        <div class="form-group">
            <input type="text" name="matricula" value="<?= isset($_POST['matricula']) ? $_POST['matricula'] : '' ?>" placeholder=" " required>
            <label>Matrícula</label>
        </div>
        <div class="form-group">
            <input type="text" name="equipo" value="<?= isset($_POST['equipo']) ? $_POST['equipo'] : '' ?>" placeholder=" " required>
            <label>Equipo</label>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input style="width: 300px;" type="text" name="comandante" value="<?= isset($_POST['comandante']) ? $_POST['comandante'] : '' ?>" placeholder=" " required>
                <label>Comandante</label>
            </div>
            <div class="form-group">
                <input style="width: 300px;" type="text" name="licencia_comandante" value="<?= isset($_POST['licencia_comandante']) ? $_POST['licencia_comandante'] : '' ?>" placeholder=" " required>
                <label>Licencia Comandante</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input style="width: 300px;" type="text" name="sub_comandante" value="<?= isset($_POST['sub_comandante']) ? $_POST['sub_comandante'] : '' ?>" placeholder=" ">
                <label>Sub Comandante</label>
            </div>
            <div class="form-group">
                <input style="width: 300px;" type="text" name="licencia_sub_comandante" value="<?= isset($_POST['licencia_sub_comandante']) ? $_POST['licencia_sub_comandante'] : '' ?>" placeholder=" ">
                <label>Licencia Sub Comandante</label>
            </div>
        </div>
        <button class="btn" type="submit">Registrar</button>
    </form>
    
</div>

</body>
</html>
