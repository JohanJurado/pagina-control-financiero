<?php

include ("../../model/datosCategoria.php");
$misCategoria = new misCategoria();
include("header.php");

// Validaciones de envio de variable
if(isset($_GET['id_categoria'])) { // la variable se trae desde el navegador
  $id_categoria = $_GET['id_categoria'];
  // Buscamos el curso a modificar o eliminar
  $respCategorias = $misCategoria->verCategoriaId($id_categoria);
  // Asignamos el resultado de la búsqueda
  if(count($respCategorias) > 0) {
    $id_cat = $respCategorias[0]['id_cat'];
    $nombre_cat = $respCategorias[0]['nombre_cat'];
  } else {
    echo '<script>
        alert ("La categoria seleccionada no fue encontrada.")
        self.location="../categorias.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar una categoria")
        self.location="../categorias.php"
        </script>';
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STOCKMASTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../libraries/style.css">

    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
  <body>
<section class="contenido">
    <?php include('barraHorizontalEdit.php') ?>
    <div class="interfaz">
        <div class="categorias overflow-auto">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>EDITAR CATEGORÍA</h6>
                    </div>
                    <form class="body">
                        <input type="text" id="id_cat" name="id_cat" readonly value="<?php echo $id_cat; ?>">
                        <input type="text" id="nombre_cat" name="nombre_cat" value="<?php echo $nombre_cat; ?>">
                        <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="editarCategoria" value="Editar">
                        </div>

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
                            <th class="text-center">N°</th>
                            <th>Categorías</th>
                            <th class="text-center acciones">Acciones</th>
                        </thead>
                        <tbody>
                            <?php
                                $respCategoria = $misCategoria->verCategoria();
                                //print_r($respUsuarios);
                                foreach ($respCategoria as $fila) { ?>
                                    <tr class="table-light">
                                        <td class="text-center"><?php echo $fila['id_cat']; ?></td>
                                        <td><?php echo $fila['nombre_cat']; ?></td>
                                        <td class="text-center d-flex justify-content-center gap-2 acciones">
                                        <a href="editarCategoria.php?id_categoria=<?php echo $fila['id_cat'] ?>" class="btn btn-info" >
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

    <script src="../../controller/funcionesCategoria.js"></script>

    <script src="../../libraries/animaciones.js"></script>
    <?php include('../footer.php') ?>
  </body>
</html>