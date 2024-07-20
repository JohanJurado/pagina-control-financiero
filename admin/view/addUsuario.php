<?php

    include ("../model/datosProveedor.php");
    $misProveedor = new misProveedor();

    include("../model/conexion.php");
    include("../model/consultas.php");
    $conexion = new conexion();
    $consultas = new consultas($conexion);

    $consultaCaja = $consultas->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    $estadoCaja = $consultaCaja[0]['estado_caja'];
    $usuarioCaja = $consultaCaja[0]['id_usCaja'];

    if ($estadoCaja!="Cerrada" && $usuarioCaja==1){
    include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jorvan Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">

    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>
<section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto d-flex justify-content-center">
            <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>AGREGAR USUARIO</h6>
                    </div>
                    <form class="body" enctype="multipart/form-data">
                        <input type="text" class="form-control" placeholder="Nombre del Usuario" id="nombre_us" name="nombre_us">
                        <input type="text" class="form-control" placeholder="Apellido del Usuario" id="apellido_us" name="apellido_us">
                        <select name="jornada_us" class="form-select" id="jornada_us">
                            <option value="" disabled selected>Jornada Usuario</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Completa">Completa</option>
                        </select>
                        <input type="number" class="form-control" placeholder="Telefono Usuario" id="telefono_us" name="telefono_us" min="3000000000" max="3999999999">
                        <input type="text" class="form-control" placeholder="Correo del Usuario" id="correo_us" name="correo_us">
                        <select name="estado_us" class="form-select" id="estado_us">
                            <option value="" disabled selected>Estado Usuario</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <select name="rol_us" class="form-select" id="rol_us">
                            <option value="" disabled selected>Rol Usuario</option>
                            <option value="Admin">Admin</option>
                            <option value="Empleado">Empleado</option>
                        </select>
                        <input type="password" class="form-control" placeholder="Contraseña Usuario" id="password" name="password">
                        <div class="d-flex gap-3 mt-1">
                            <input type="button" class="btn btn2" id="registrarUsuario" value="Agregar Usuario" placeholder="Agregar Usuario" required>
                            <a type="button" href="./usuario.php" class="btn btn-dark">Ver Usuarios</a>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
        <script src="../controller/funcionesUsuario.js"></script>
        <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>    

        
    <?php
    
        } else {
            echo '<script>
                    alert("Error al acceder. La cuenta esta inactiva o el usuario activo no tiene un rol de admin, por lo cual no puede acceder a este apartado")
                </script>';
        }

    ?>


</body>
</html>