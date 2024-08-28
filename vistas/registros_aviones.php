<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'trabajador') {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

// Obtener todos los registros de aviones
$registros = obtenerRegistros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Aviones</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   
    <link href="../styles.css" rel="stylesheet">
</head>
<body>
    <div style="font-family: Poppins" class="w-full h-[100vh] bg-gray-50  ">

    <div class="w-full flex justify-between p-1 py-6 px-5 h-[100px] border-b shadow items-center " >
        
        <div class="avatar flex  font-semibold text-xl text-blue-500 p-2 px-2 items-center  rounded-lg ">
        <img style="width: 60px; border-radius:50%; " src="../images/omanav.jpg"   alt="">
            <p style="margin-right: 4px; margin-left:10px; "  >Bienvenido</p>
        <?php echo $_SESSION['usuario'] ; ?>
        <p>!</p>
      </div>

      <div class="botones-nav bg-blue-600 text-white p-2 rounded-lg ">
            <a href="dashboard_trabajador.php" class="btn">Crear Registro</a>
        </div>

        <div style="background-color: red; display: flex; color: white; padding: 6px; border-radius:10px; "  >
        <a style="margin-right: 4px;  " href="../logout.php">Cerrar Sesion</a>
        <img src="../images/exit.svg" alt="">
        </div>

    </div>

       
        <div class="bg-slate-500 text-center m-auto mt-5  " >
        <h1 class="text-2xl font-semibold mb-5 " >Registros de Aviones</h1>
        <div class="table-container mt-5 p-2 px-5 ">
            <table style=" " class="m-auto  w-full shadow-xl border " >
                <thead style="height: 50px;   " class="shadow bg-blue-600 text-white " >
                    <tr >
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Matrícula</th>
                        <th>Equipo</th>
                        <th>Comandante</th>
                        <th>Licencia Comandante</th>
                        <th>Sub Comandante</th>
                        <th>Licencia Sub Comandante</th>
                        <th>Número de Pasajeros</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                    <tr style="height:50px; " class="shadow" >
                        <td><?php echo $registro['fecha']; ?></td>
                        <td><?php echo $registro['hora']; ?></td>
                        <td><?php echo $registro['matricula']; ?></td>
                        <td><?php echo $registro['equipo']; ?></td>
                        <td><?php echo $registro['comandante']; ?></td>
                        <td><?php echo $registro['licencia_comandante']; ?></td>
                        <td><?php echo $registro['sub_comandante']; ?></td>
                        <td><?php echo $registro['licencia_sub_comandante']; ?></td>
                        <td><?php echo $registro['num_pasajeros']; ?></td>
                        <td>
                            <a href="editar_avion.php?id=<?php echo $registro['id']; ?>" class="bg-blue-600"   >
                                <img style="margin-left:25px; " src="../images/edit.svg" alt="">
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
        
    </div>
</body>
</html>