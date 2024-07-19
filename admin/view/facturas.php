
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
        include('../model/datosFactura.php');
        include('../model/datosProveedor.php');

        $misFactura = new misFactura();
        $misProveedor = new misProveedor();

    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
            <div class="filtros">
                <h4>Filtros:</h4>
                <div class="consultas">
                    <form action="../model/accionesFactura.php?accion=filtrar&atributo=fecha" class="filtro" method="post">
                        <div class="">
                            <label for="fecha" class="form-label">Fecha: </label>
                            <input type="date" id="fecha" name="fecha" value="" class="form-control w-75">
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroFecha" value="Filtro Fecha">
                    </form>
                    <form action="../model/accionesFactura.php?accion=filtrar&atributo=id"  class="filtro" method="post">
                        <div class="">
                            <label for="id" class="form-label">N° Factura: </label>
                            <input type="number" name="id" id="id" value="" class="form-control w-50">
                        </div>
                        <input type="submit" class="btn btn2 w-50" id="filtroId" value="Filtro Factura">
                    </form>
                    <form action="../model/accionesFactura.php?accion=filtrar&atributo=estado"  class="filtro" method="post">
                        <div class="">
                            <label for="estado" class="form-label">Estado Factura: </label>
                            <select name="estado" id="estado" class="form-select w-75">
                                <option value="" selected>Ninguno</option>
                                <option value="Pagado">Pagado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Falta Totalizar Factura">Falta Totalizar Factura</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroEstado" value="Filtro Estado">
                    </form>
                    <form action="../model/accionesFactura.php?accion=filtrar&atributo=proveedor"  class="filtro" method="post">
                        <div class="">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <select name="proveedor" id="proveedor" class="form-select w-75">
                                <option value="" selected>Ninguno</option>
                                <?php
                                    $respProveedor = $misProveedor->verProveedor();
                                    foreach ($respProveedor as $fila) {
                                        if ($fila['id_prov']!=1){?>
                                        <option value=<?php echo $fila['id_prov']; ?>><?php echo $fila['nombre_prov']; ?></option>
                                <?php
                                    }}
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroProveedor" value="Filtro Proveedor">
                    </form>
                </div>
            </div>

            <div class="categorias overflow-auto m-0">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6 class="mb-1">LISTA DE FACTURAS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center" style="width: 5rem">Fecha</th>
                                <th class="text-center" style="width: 3rem">N°</th>
                                <th class="text-center" style="width: 5.5rem">Total</th>
                                <th class="text-center" style="width: 5rem">Abono</th>
                                <th class="text-center" style="width: 5rem">Pendiente</th>
                                <th class="text-center" style="width: 7rem">Estado de Pago</th>
                                <th  class="text-center" style="width: 7rem">Proveedor</th>
                                <th class="text-center" style="width: 3.5rem">Acciones</th>
                            </thead>
                            <tbody>
                                <?php

                                    $consulta="SELECT * FROM factura";
                                    if (isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                            
                                    $respFactura = $misFactura->verFactura($consulta);
                                    foreach ($respFactura as $fila) {
                                        if ($fila['id_provFac']!=1){
                                            $nom_proveedor = $misProveedor->verProveedorId($fila['id_provFac']);?>
                                            <tr class="table-light">
                                                <td class="text-center"><?php echo $fila['fecha_fac']; ?></td>
                                                <td class="text-center"><?php echo $fila['id_fac']; ?></td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['total_fac']); ?></td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['abono_fac']); ?></td>

                                                <?php 
                                                    if($fila['total_fac']-$fila['abono_fac']!=0){
                                                    echo '<td class="text-center"><p class="m-0 campo amarillo"> $'.number_format($fila["total_fac"]-$fila["abono_fac"]).'</p></td>';
                                                    } else {
                                                    echo '<td class="text-center"><p class="m-0 campo verde">N/A</p></td>';
                                                    }
                                                ?>

                                                <td class="text-center"><?php echo $fila['estado_fac']; ?></td>
                                                <td class="text-center"><?php echo $nom_proveedor[0]['nombre_prov']; ?></td>
                                                <td><center>
                                                    <a href="edit/editarFacturas.php?id_factura=<?php echo $fila['id_fac'] ?>" class="btn btn-info" >
                                                        <i class="bi bi-subtract"></i>
                                                        <p class="m-0">Editar</p>
                                                    </a></center>
                                                </td>
                                            </tr>     
                                <?php
                                        }
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
        
        <script src="../controller/funcionesFactura.js"></script>

    </section>
    <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>
  </body>
</html>

