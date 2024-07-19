
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
<body>   
    <?php 
        include('header.php');
        include('../model/datosUsuario.php');
        $misUsuario = new misUsuarios();
    ?>
    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
            <div class="categorias">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>LISTA DE USUARIOS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Jornada</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Rol</th>
                                <th>Password</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta="SELECT * FROM usuario";
                                    if(isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                                    $respUsuario = $misUsuario->verUsuario($consulta);
                                    foreach ($respUsuario as $fila) { 
                                        ?>
                                        <tr class="table-light">
                                            <td class="text-center"><?php echo $fila['id_us']; ?></td>
                                            <td><?php echo $fila['nombre_us'];?></td>
                                            <td><?php echo $fila['apellido_us'];?></td>
                                            <td><?php echo $fila['jornada_us'];?></td>
                                            <td><?php echo $fila['telefono_us'];?></td>
                                            <td><?php echo $fila['correo_us']; ?></td>
                                            <td><?php echo $fila['estado_us'];?></td>
                                            <td><?php echo $fila['rol_us']; ?></td>
                                            <td><?php echo $fila['password']; ?></td>
                                            <td><center>
                                                <a href="edit/editarUsuario.php?id_us=<?php echo $fila['id_us'] ?>" class="btn btn-info" >
                                                    <i class="bi bi-subtract"></i>
                                                    <p class="m-0">Editar</p>
                                                </a>
                                                </center>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>       
        </div>
        <script src="../controller/funcionesUsuario.js"></script>
        <script src="../libraries/animaciones.js"></script>
        <?php include('footer.php') ?>
    </section>
</body>
</html>