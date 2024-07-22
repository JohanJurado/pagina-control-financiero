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
include("header.php");
?>
<!doctype html>
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
<section class="contenido">
    <?php include('barraHorizontal.php') ?>
    <div class="interfaz d-flex justify-content-center overflow-auto">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>AÑADIR FACTURA</h6>
                    </div>
                    <form class="body">
                        <div>
                            <label for="id_fac" class="form-label">Fecha Factura:</label>
                            <input class="form-control" type="date" id="fecha_fac" name="fecha_fac">
                        </div>
                        <div>
                            <label for="total_fac" class="form-label">Total Factura:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="total_fac" name="total_fac">
                            </div>
                        </div>
                        <div>
                            <label for="estado_fac" class="form-label">Estado Factura:</label>
                            <select name="estado_fac" id="estado_fac" class="form-select">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Pagado">Pagado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Falta Totalizar Factura">Falta Totalizar Factura</option>
                            </select>
                        </div>
                        <div>
                            <label for="abono_fac" class="form-label">Abono Realizado:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" aria-label="abono_fac" type="number" id="abono_fac" name="abono_fac" value="">
                            </div>
                        </div>
                        <div>
                            <label for="id_provFac" class="form-label">Proveedor:</label>
                            <select class="form-select" name="id_provFac" id="id_provFac">
                                <option value="" disabled selected>Seleccione...</option>
                                <?php
                                    $respProveedor = $misProveedor->verProveedor();
                                    foreach ($respProveedor as $fila) {
                                        if($fila['id_prov']!=1){  ?>
                                            <option value='<?php echo $fila['id_prov']; ?>'><?php echo $fila['nombre_prov']; ?></option>
                                <?php
                                        
                                    }}
                                ?>
                            </select>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="registrarFactura" value="Registrar Factura">
                            <a type="button" href="./facturas.php" class="btn btn-dark">Ver Facturas</a>
                        </div>

                    </form>
                </div>
        </div>
    </div>

    <script src="../controller/funcionesFactura.js"></script>

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