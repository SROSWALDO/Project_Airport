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
    <a href="registros_aviones.php" class="botones-nav">Crear Registro</a>
    <div class="logout">
        <a style="text-decoration:none; color:white; "  href="../logout.php">Cerrar Sesión</a>
        <img src="../images/exit.svg" alt="">
    </div>
</div>

<div class="container">
    <h2>Registrar Avión</h2>
    <form method="POST">
        <div class="form-group">
            <input type="date" name="fecha" required>
            <label>Fecha</label>
        </div>
        <div class="form-group">
            <input type="time" name="hora" required>
            <label>Hora</label>
        </div>
        <div class="form-group">
            <input type="number" name="num_pasajeros" placeholder=" " required>
            <label>Número de Pasajeros</label>
        </div>
        <div class="form-group">
            <input type="text" name="matricula" placeholder=" " required>
            <label>Matrícula</label>
        </div>
        <div class="form-group">
            <input type="text" name="equipo" placeholder=" " required>
            <label>Equipo</label>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input style="width: 300px;" type="text" name="comandante" placeholder=" " required>
                <label>Comandante</label>
            </div>
            <div class="form-group">
                <input style="width: 300px;" type="text" name="licencia_comandante" placeholder=" " required>
                <label>Licencia Comandante</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input style="width: 300px;" type="text" name="sub_comandante" placeholder=" ">
                <label>Sub Comandante</label>
            </div>
            <div class="form-group">
                <input style="width: 300px;" type="text" name="licencia_sub_comandante" placeholder=" ">
                <label>Licencia Sub Comandante</label>
            </div>
        </div>
        <button class="btn" type="submit">Registrar</button>
    </form>
    <?php if (isset($mensaje)) { echo "<p class='message success'>$mensaje</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='message error'>$error</p>"; } ?>
</div>

</body>
</html>
