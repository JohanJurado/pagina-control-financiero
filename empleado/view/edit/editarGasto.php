<?php

include('../../model/datosGasto.php');
include('../../model/datosCaja.php');
include('../../model/datosFactura.php');
include('../../model/datosUsuario.php');

$misFactura = new misFactura();
$misCaja = new misCaja();
$misGasto = new misGasto();
$misUsuario = new misUsuarios();

// Validaciones de envio de variable
if(isset($_GET['id_gasto'])) { // la variable se trae desde el navegador
  $id_gasto = $_GET['id_gasto'];
  // Buscamos el curso a modificar o eliminar
  $respGasto = $misGasto->verGastoId($id_gasto);
  // Asignamos el resultado de la búsqueda
  if(count($respGasto) > 0) {
    $id_gasto = $respGasto[0]['id_gasto'];
    $nombre_gasto = $respGasto[0]['nombre_gasto'];
    $desc_gasto = $respGasto[0]['desc_gasto'];
    $metodopago_gasto = $respGasto[0]['metodopago_gasto'];
    $total_gasto = $respGasto[0]['total_gasto'];
    $tipo_gasto = $respGasto[0]['tipo_gasto'];
    $id_facturaGasto = $respGasto[0]['id_facturaGasto'];
    $fecha_gasto = $respGasto[0]['fecha_gasto'];

    $id_caja = $misCaja->verCajaId($respGasto[0]['id_cajaGasto']);
    $usuario = $misUsuario->verUsuarioId($id_caja[0]['id_usCaja']);
    $nombre_usuario = $usuario[0]['nombre_us'];

  } else {
    echo '<script>
        alert ("La factura seleccionada no fue encontrada.")
        self.location="../gastos.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar una factura")
        self.location="../gastos.php"
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
    <?php include('barraHorizontalEdit.php') ?>
    <div class="interfaz overflow-auto d-flex justify-content-center">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>EDITAR GASTO</h6>
                    </div>
                    <form class="body">
                        <div>
                            <label for="id_gasto" class="form-label">Id Gasto:</label>
                            <input class="form-control" type="text" id="id_gasto" name="id_gasto" readonly value=<?php echo $id_gasto; ?>>
                        </div>
                        <div>
                            <label for="nombre_gasto" class="form-label">Nombre Gasto:</label>
                            <input class="form-control" type="text" id="nombre_gasto" name="nombre_gasto" value="<?php echo $nombre_gasto; ?>">
                        </div>
                        <div>
                            <label for="desc_gasto" class="form-label">Descripcion Gasto:</label>
                            <input class="form-control" type="text" id="desc_gasto" name="desc_gasto" value="<?php echo $desc_gasto; ?>">
                        </div>
                        <div>
                            <label for="metodopago_gasto" class="form-label">Metodo Pago:</label>
                            <select name="metodopago_gasto" id="metodopago_gasto" class="form-select">
                                <option value="<?php echo $metodopago_gasto; ?>" selected><?php echo $metodopago_gasto; ?></option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>
                        <div>
                            <label for="total_gasto" class="form-label">Total Gasto:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" aria-label="total_gasto" type="number" id="total_gasto" name="total_gasto" value=<?php echo $total_gasto; ?> readonly>
                            </div>
                        </div>
                        <div>
                            <label for="tipo_gasto" class="form-label">Tipo Gasto:</label>
                            <input class="form-control" type="text" id="tipo_gasto" name="tipo_gasto" value="<?php echo $tipo_gasto; ?>" readonly>
                        </div>
                        <div>
                            <label for="id_cajaGasto" class="form-label">Encargado:</label>
                            <select name="id_cajaGasto" id="id_cajaGasto" class="form-select">
                                <option value="<?php echo $respGasto[0]['id_cajaGasto']; ?>" selected><?php echo $nombre_usuario; ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="id_facturaGasto" class="form-label">Id Factura:</label>
                            <select name="id_facturaGasto" id="id_facturaGasto" class="form-select">
                                <?php
                                    if ($id_facturaGasto==1){?>
                                        <option value="<?php echo $id_facturaGasto; ?>" selected>Ninguna</option>
                                <?php
                                    } else {?>
                                    <option value="<?php echo $id_facturaGasto; ?>" selected><?php echo $id_facturaGasto; ?></option>
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
                            <input type="button" class="btn btn2 w-50" id="editarGasto" value="Editar">
                        </div>

                    </form>
                </div>
        </div>
    </div>

    <script src="../../controller/funcionesGasto.js"></script>

    <script src="../../libraries/animaciones.js"></script>
    <?php include('../footer.php') ?>
  </body>
</html>