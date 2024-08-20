
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
    <title>STOCKMASTER</title>
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
        include('../model/datosVenta.php');
        include('../model/datosCaja.php');
        include('../model/datosUsuario.php');

        $misVenta = new misVenta();
        $misCaja = new misCaja();
        $misUsuario = new misUsuarios();

    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
            <div class="filtros">
                <h4>Filtros:</h4>
                <div class="consultas">
                    <form action="../model/accionesVenta.php?accion=filtrar&atributo=fecha" class="filtro" method="post" enctype="multipart/form-data">
                        <div class="">
                            <label for="fecha" class="form-label">Fecha: </label>
                            <input type="date" id="fecha" name="fecha" value="" class="form-control w-75">
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroFecha" value="Filtro Fecha">
                    </form>
                    <form action="../model/accionesVenta.php?accion=filtrar&atributo=id" class="filtro" method="post">
                        <div class="">
                            <label for="id" class="form-label">N° Venta: </label>
                            <input type="number" name="id" id="id" value="" class="form-control w-50">
                        </div>
                        <input type="submit" class="btn btn2 w-50" id="filtroId" value="Filtro Venta">
                    </form>
                    <form action="../model/accionesVenta.php?accion=filtrar&atributo=metodo_pago"  class="filtro" method="post" enctype="multipart/form-data">
                        <div class="">
                            <label for="metodo_pago" class="form-label">Método de Pago: </label>
                            <select name="metodo_pago" id="metodo_pago" class="form-select w-75">
                                <option value="" selected>Ninguno</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroMetodo" value="Filtro Metodo">
                    </form>
                    <form action="../model/accionesVenta.php?accion=filtrar&atributo=nombreUsuario" class="filtro" method="post">
                        <div class="">
                            <datalist id="nombreUsuario">
                                <?php
                                $respNombreUsuario=$misUsuario->verUsuario();
                                foreach($respNombreUsuario as $fila){?>
                                <option value="<?php echo $fila['nombre_us'] ?>"><?php echo $fila['nombre_us'] ?></option>
                                <?php } ?>
                            </datalist>
                            <label for="nombreUsuario" class="form-label">Encargado:</label>
                            <input type="text" list="nombreUsuario" name="nombreUsuario" id="nombreUsuario" class="form-control w-75" value="">
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroNombre" value="Filtro Nombre">
                    </form>
                </div>
            </div>

            <div class="categorias overflow-auto m-0">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6 class="mb-1">LISTA DE VENTAS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center" style="width: 3rem">N°</th>
                                <th class="text-center" style="width: 3rem">Fecha</th>
                                <th class="text-center" style="width: 5.5rem">Método de pago</th>
                                <th class="text-center" style="width: 5rem">Valor Venta</th>
                                <th class="text-center" style="width: 4rem">Encargado</th>
                            </thead>
                            <tbody>
                                <?php

                                    $consulta="SELECT * FROM venta ORDER BY id_ven DESC";
                                    if (isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                                    $respVenta = $misVenta->verVenta($consulta);

                                    if(empty($respVenta)){
                                        echo "<tr><td colspan='5' class=' fs-5 text-bg-primary text-center'>No hay ventas que coincidan</td></tr>";
                                    }
                                    foreach ($respVenta as $fila) {
                                            if ($fila['valortotal_ven']!=0){
                                            $id_caja = $misCaja->verCajaId($fila['id_cajaVenta']);
                                            $nom_usuario = $misUsuario->verUsuarioId($id_caja[0]['id_usCaja']);?>
                                            <tr class="table-light">
                                                <td class="text-center"><?php echo $fila['id_ven'];?></td>
                                                <td class="text-center"><?php echo $fila['fecha_ven'];?></td>
                                                <td class="text-center"><?php echo ($fila['metodopago_ven']);?></td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['valortotal_ven']);?></td>
                                                <td class="text-center"><?php echo $nom_usuario[0]['nombre_us'];?></td>
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
        
        <script src="../controller/funcionesVenta.js"></script>

    </section>
    <script src="../libraries/animaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        pagVentas();
    });
    </script>

    <?php
        
        } else {
            echo '<script>
                    alert("Error al acceder. La cuenta esta inactiva o el usuario activo no tiene un rol de admin, por lo cual no puede acceder a este apartado")
                </script>';
        }

    ?>

  </body>
</html>

