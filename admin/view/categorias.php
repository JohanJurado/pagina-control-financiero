
<?php

    include("../model/conexion.php");
    include("../model/consultas.php");
    $conexion = new conexion();
    $consultas = new consultas($conexion);

    $consultaCaja = $consultas->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    $estadoCaja = $consultaCaja[0]['estado_caja'];
    $usuarioCaja = $consultaCaja[0]['id_usCaja'];

    if ($estadoCaja!="Cerrada" && $usuarioCaja==1){
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">
    
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
  <body>

    <?php 
        include('header.php');
        include('../model/datosCategoria.php');

        $misCategoria = new miscategoria();
    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz">
            <div class="categorias overflow-auto">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>AGREGAR CATEGORIA</h6>
                    </div>
                    <form class="body">
                        <input type="text" placeholder="Nombre de la Categoria" id="nombre_cat" name="nombre_cat">
                        <input type="button" class="btn btn2" id="registrarCategoria" value="Agregar Categoria">
                    </form>
                </div>
                <div class="tabla f-2">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>LISTA DE CATEGORÍAS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center">#</th>
                                <th>Categorias</th>
                                <th class="text-center acciones">Acciones</th>
                            </thead>
                            <tbody>
                                <?php
                                    $respCategoria = $misCategoria->verCategoria();
                                    foreach ($respCategoria as $fila) { ?>
                                        <tr class="table-light">
                                            <td class="text-center"><?php echo $fila['id_cat']; ?></td>
                                            <td><?php echo $fila['nombre_cat']; ?></td>
                                            <td class="text-center d-flex justify-content-center gap-2 acciones">
                                                <a href="edit/editarCategoria.php?id_categoria=<?php echo $fila['id_cat'] ?>" class="btn btn-info" >
                                                    <i class="bi bi-subtract"></i>
                                                    <p class="m-0">Editar</p>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>       
        </div>
        
        <script src="../controller/funcionesCategoria.js"></script>

    </section>
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

