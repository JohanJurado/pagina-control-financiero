<?php

include('../model/datosCaja.php');
include('../model/datosFactura.php');
include('../model/datosUsuario.php');
include('../model/datosProveedor.php');
include('../model/consultas.php');
include('../model/conexion.php');

$conexion = new Conexion();
$misFactura = new misFactura();
$misCaja = new misCaja();
$misProveedor = new misProveedor();
$misUsuario = new misUsuarios();
$consultas = new consultas($conexion);

$consulta_nombre_usuario="SELECT nombre_us FROM caja c, usuario u WHERE c.id_usCaja=u.id_us and c.id_caja=(SELECT max(id_caja) FROM caja);";
$nombre_usuario=$consultas->consultaMultiple($consulta_nombre_usuario);

$consulta_id_caja="SELECT max(id_caja) as 'id_caja' FROM caja;";
$id_caja=$consultas->consultaMultiple($consulta_id_caja);

$consulta_ids_facturas="SELECT * FROM `factura` WHERE estado_fac='Pendiente' ORDER BY id_fac DESC;";
$ids_facturas=$consultas->consultaMultiple($consulta_ids_facturas);

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

    <section class="header">
        <div class="nombre">
            <p class="m-0">JORVAN - INVENTORY</p>
        </div>
        <div class="fecha">
            <p><?php date_default_timezone_set('America/Bogota'); echo date("d/m/Y  g:i a");?></p>
            <div class="perfil">
                <p class="m-0">Perfil Admin</p>
                <div class="clicPerfil d-none">
                    <p class="m-0">
                        <i class="bi bi-person-circle"></i>    
                        Perfil
                    </p>
                    <p class="m-0">
                        <i class="bi bi-power"></i>
                        Salir
                    </p>
                </div>
            </div>
        </div>
    </section>
<section class="contenido">
    <?php include('barraHorizontal.php') ?>
    <div class="interfaz overflow-auto d-flex justify-content-center">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>AGREGAR GASTO</h6>
                    </div>
                    <form class="body">
                        <div>
                            <label for="nombre_gasto" class="form-label">Nombre Gasto:</label>
                            <input class="form-control" type="text" id="nombre_gasto" name="nombre_gasto">
                        </div>
                        <div>
                            <label for="desc_gasto" class="form-label">Descripcion Gasto:</label>
                            <input class="form-control" type="text" id="desc_gasto" name="desc_gasto" >
                        </div>
                        <div>
                            <label for="metodopago_gasto" class="form-label">Metodo Pago:</label>
                            <select name="metodopago_gasto" id="metodopago_gasto" class="form-select">
                                <option disabled selected>Seleccione...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>
                        <div>
                            <label for="total_gasto" class="form-label">Total Gasto:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" aria-label="total_gasto" type="number" id="total_gasto" name="total_gasto">
                            </div>
                        </div>
                        <div>
                            <label for="tipo_gasto" class="form-label">Tipo Gasto:</label>
                            <select name="tipo_gasto" id="tipo_gasto" class="form-select">
                                <option disabled selected>Seleccione...</option>
                                <?php
                                    if ($nombre_usuario[0]['nombre_us']=="Jorvan"){?>
                                        <option value="Factura">Factura</option> 
                                <?php
                                    }
                                ?>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="id_cajaGasto" class="form-label">Encargado:</label>
                            <select name="id_cajaGasto" id="id_cajaGasto" class="form-select">
                                <option value="<?php echo $id_caja[0]['id_caja']; ?>" selected><?php echo $nombre_usuario[0]['nombre_us']; ?></option>
                            </select>
                        </div>
                        <div class="d-none">
                            <label for="id_facturaGasto" class="form-label">Id Factura:</label>
                            <select name="id_facturaGasto" id="id_facturaGasto" class="form-select">
                                <option value="1" selected>Ninguna</option>
                                <option value="1" disabled>N°/Fecha/Total/Abono/Proveedor</option>
                                <?php
                                    foreach ($ids_facturas as $fila) {
                                        $respProveedor=$misProveedor->verProveedorId($fila['id_provFac'])?>
                                        <option value='<?php echo $fila['id_fac']; ?>'>
                                            <?php echo 
                                                $fila['id_fac']." / ".
                                                $fila['fecha_fac']." / $".
                                                number_format($fila['total_fac'])." / $".
                                                number_format($fila['abono_fac'])." / ".
                                                $respProveedor[0]['nombre_prov']
                                            ?>
                                        </option>
                                <?php
                                        
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="fecha_gasto" class="form-label">Fecha Gasto:</label>
                            <input class="form-control" type="date" id="fecha_gasto" name="fecha_gasto" value="<?php echo $fecha_gasto; ?>">
                        </div>
                        
                        <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="registrarGasto" value="Registrar Gasto">

                        </div>

                    </form>
                </div>
        </div>
    </div>

    <script src="../controller/funcionesGasto.js"></script>

    <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>
  </body>
</html>