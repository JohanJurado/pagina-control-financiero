<?php

include ("../../model/datosProveedor.php");
$misProveedor = new misProveedor();
include("header.php");
// Validaciones de envio de variable
if(isset($_GET['id_prov'])) { // la variable se trae desde el navegador
  $id_prov = $_GET['id_prov'];
  // Buscamos el curso a modificar o eliminar
  $respProveedores = $misProveedor->verProveedorId($id_prov);
  // Asignamos el resultado de la búsqueda
  if(count($respProveedores) > 0) {
    $id_prov = $respProveedores[0]['id_prov'];
    $nombre_prov = $respProveedores[0]['nombre_prov'];
  } else {
    echo '<script>
        alert ("El proveedor seleccionado no fue encontrado.")
        self.location="../proveedores.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar un proveedor")
        self.location="../proveedores.php"
        </script>';
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
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
                        <h6>EDITAR PROVEEDOR</h6>
                    </div>
                    <form class="body">
                        <input type="text" id="id_prov" name="id_prov" readonly value="<?php echo $id_prov; ?>">
                        <input type="text" id="nombre_prov" name="nombre_prov" value="<?php echo $nombre_prov; ?>">
                        <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="editarProveedor" value="Editar">
                        </div>

                    </form>
                </div>
                <div class="tabla f-2">
                <div class="head">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <h6>LISTA DE PROVEEDORES</h6>
                </div>
                <div class="body">
                    <table class="table" border="1px">
                        <thead class="table-default">
                            <th class="text-center">#</th>
                            <th>PROVEEDORES</th>
                            <th class="text-center acciones">Acciones</th>
                        </thead>
                        <tbody>
                            <?php
                                $respProveedores = $misProveedor->verProveedor();
                                //print_r($respUsuarios);
                                foreach ($respProveedores as $fila) { 
                                    if ($fila['nombre_prov']!="Sin Proveedor"){?>
                                    <tr class="table-light">
                                        <td class="text-center"><?php echo $fila['id_prov']; ?></td>
                                        <td><?php echo $fila['nombre_prov']; ?></td>
                                        <td class="text-center d-flex justify-content-center gap-2 acciones">
                                        <a href="editarProveedor.php?id_prov=<?php echo $fila['id_prov'] ?>" class="btn btn-info" >
                                                <i class="bi bi-subtract"></i>
                                                <p class="m-0">Editar</p>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }}
                            ?>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../controller/funcionesProveedor.js"></script>

    <script src="../../libraries/animaciones.js"></script>
    <?php include('../footer.php') ?>
  </body>
</html>