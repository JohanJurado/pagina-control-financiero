
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
        include('../model/datosGasto.php');
        include('../model/datosCaja.php');
        include('../model/datosFactura.php');
        include('../model/datosUsuario.php');

        $misFactura = new misFactura();
        $misCaja = new misCaja();
        $misGasto = new misGasto();
        $misUsuario = new misUsuarios();

    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
            <div class="filtros">
                <h4>Filtros:</h4>
                <div class="consultas">
                    <form action="../model/accionesGasto.php?accion=filtrar&atributo=fecha" class="filtro gap-3" method="post">
                        <div class="d-flex gap-4">
                            <div>
                                <label for="fechaInicio" class="form-label">Fecha Inicio: </label>
                                <input type="date" id="fechaInicio" name="fechaInicio" value="" class="form-control w-100">
                            </div>
                            <div>
                                <label for="fechaFin" class="form-label">Fecha Fin: </label>
                                <input type="date" id="fechaFin" name="fechaFin" value="" class="form-control w-100">
                            </div>
                        </div>
                        <input type="submit" class="btn btn2 w-100" id="filtroFecha" value="Filtro Fecha">
                    </form>
                    <form action="../model/accionesGasto.php?accion=filtrar&atributo=nombre"  class="filtro" method="post">
                        <div class="">
                            <datalist id="nombre">
                                <?php
                                    $respNombreGasto=$misGasto->verGasto("SELECT * FROM gasto");
                                    foreach($respNombreGasto as $fila){?>
                                        <option value="<?php echo $fila['nombre_gasto'] ?>"></option>
                                <?php } ?>
                            </datalist>
                            <label for="nombre" class="form-label">Nombre Gasto:</label>
                            <input type="text" list="nombre" name="nombre" id="nombre" class="form-control" value="">
                        </div>
                        <input type="submit" class="btn btn2 w-100" id="filtroNombre" value="Filtro Nombre">
                    </form>
                    <form action="../model/accionesGasto.php?accion=filtrar&atributo=tipo"  class="filtro" method="post">
                        <div class="">
                            <label for="tipo" class="form-label">Tipo Gasto:</label>
                            <select name="tipo" id="tipo" class="form-select">
                                <option value="" selected>Ninguno</option>
                                <option value="Otro">Otro</option>
                                <option value="Factura">Factura</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-100" id="filtroTipo" value="Filtro Tipo">
                    </form>
                </div>
            </div>

            <div class="categorias m-0">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6 class="mb-1">LISTA DE GASTOS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center" style="width: 3rem">Fecha</th>
                                <th class="text-center" style="width: 5rem">Nombre</th>
                                <th class="text-center" style="width: 7rem">Descripcion</th>
                                <th class="text-center" style="width: 3rem">Metodo</th>
                                <th  class="text-center" style="width: 3rem">Total</th>
                                <th class="text-center" style="width: 4rem">Tipo</th>
                                <th class="text-center" style="width: 4rem">Encargado</th>
                                <th class="text-center" style="width: 2.5rem">Acciones</th>
                            </thead>
                            <tbody>
                                <?php

                                    $consulta="SELECT * FROM gasto ORDER BY id_gasto DESC";
                                    if (isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                            
                                    $respGasto = $misGasto->verGasto($consulta);

                                    if(empty($respGasto)){
                                        echo "<tr><td colspan='8' class=' fs-5 text-bg-primary text-center'>No hay gastos que coincidan</td></tr>";
                                    }

                                    foreach ($respGasto as $fila) { 
                                        $id_caja = $misCaja->verCajaId($fila['id_cajaGasto']);
                                        $nombre_usuario = $misUsuario->verUsuarioId($id_caja[0]['id_usCaja']);?>
                                        <tr class="table-light">
                                            <td class="text-center"><?php echo $fila['fecha_gasto']; ?></td>
                                            <td class="text-center"><?php echo $fila['nombre_gasto']; ?></td>
                                            <td class="text-center"><?php echo $fila['desc_gasto']; ?></td>
                                            <td class="text-center"><?php echo $fila['metodopago_gasto']; ?></td>
                                            <td class="text-center"><?php echo '$'.number_format($fila['total_gasto']); ?></td>
                                            <td class="text-center"><?php echo $fila['tipo_gasto']; ?></td>
                                            
                                            <td class="text-center"><?php echo $nombre_usuario[0]['nombre_us']; ?></td>
                                            <td><center>
                                                <a href="edit/editarGasto.php?id_gasto=<?php echo $fila['id_gasto'] ?>" class="btn btn-info" >
                                                    <i class="bi bi-subtract"></i>
                                                    <p class="m-0">Editar</p>
                                                </a></center>
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
        
        <script src="../controller/funcionesGasto.js"></script>

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

