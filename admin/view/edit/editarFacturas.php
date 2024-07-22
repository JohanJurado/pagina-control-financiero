<?php

include ("../../model/datosFactura.php");
include ("../../model/datosProveedor.php");
$misFactura = new misFactura();
$misProveedor = new misProveedor();
include("header.php");

// Validaciones de envio de variable
if(isset($_GET['id_factura'])) { // la variable se trae desde el navegador
  $id_factura = $_GET['id_factura'];
  // Buscamos el curso a modificar o eliminar
  $respFacturas = $misFactura->verFacturaId($id_factura);
  // Asignamos el resultado de la búsqueda
  if(count($respFacturas) > 0) {
    $id_fac = $respFacturas[0]['id_fac'];
    $fecha_fac = $respFacturas[0]['fecha_fac'];
    $total_fac = $respFacturas[0]['total_fac'];
    $estado_fac = $respFacturas[0]['estado_fac'];
    $abono_fac = $respFacturas[0]['abono_fac'];
    $id_provFac = $respFacturas[0]['id_provFac'];

    $respProveedor = $misProveedor->verProveedorId($id_provFac);
    $nombre_provFac = $respProveedor[0]['nombre_prov'];

  } else {
    echo '<script>
        alert ("La factura seleccionada no fue encontrada.")
        self.location="../facturas.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar una factura")
        self.location="../facturas.php"
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
    <div class="interfaz overflow-auto d-flex justify-content-center">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>EDITAR FACTURA</h6>
                    </div>
                    <form class="body">
                        <div>
                            <label for="id_fac" class="form-label">Id Factura:</label>
                            <input class="form-control" type="text" id="id_fac" name="id_fac" readonly value=<?php echo $id_fac; ?>>
                        </div>
                        <div>
                            <label for="id_fac" class="form-label">Fecha Factura:</label>
                            <input class="form-control" type="date" id="fecha_fac" name="fecha_fac" value="<?php echo $fecha_fac; ?>">
                        </div>
                        <div>
                            <label for="total_fac" class="form-label">Total Factura:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="total_fac" name="total_fac" value= <?php echo $total_fac; ?>>
                            </div>
                        </div>
                        <div>
                            <label for="estado_fac" class="form-label">Estado Factura:</label>
                            <select name="estado_fac" id="estado_fac" class="form-select">
                                <option value="<?php echo $estado_fac; ?>" selected><?php echo $estado_fac; ?></option>
                                <option value="Pagado">Pagado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Falta Totalizar Factura">Falta Totalizar Factura</option>
                            </select>
                        </div>
                        <div>
                            <label for="abono_fac" class="form-label">Abono Realizado:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" aria-label="abono_fac" type="number" id="abono_fac" name="abono_fac" value=<?php echo $abono_fac; ?>>
                            </div>
                        </div>
                        <div>
                            <label for="id_provFac" class="form-label">Proveedor:</label>
                            <select class="form-select" name="id_provFac" id="id_provFac">
                                <option value="<?php echo $id_provFac; ?>" selected><?php echo $nombre_provFac; ?></option>
                                <?php
                                    $respProveedor = $misProveedor->verProveedor();
                                    foreach ($respProveedor as $fila) {
                                        if($id_provFac!=$fila['id_prov'] && $fila['id_prov']!=1){  ?>
                                            <option value='<?php echo $fila['id_prov']; ?>'><?php echo $fila['nombre_prov']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="editarFactura" value="Editar">
                            <input type="button" class="btn btn-danger" id="eliminarFactura" value="Eliminar">
                        </div>

                    </form>
                </div>
        </div>
    </div>

    <script src="../../controller/funcionesFactura.js"></script>

    <script src="../../libraries/animaciones.js"></script>
    <?php include('../footer.php') ?>
  </body>
</html>