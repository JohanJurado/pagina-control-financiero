
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
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
<body>   
    <?php 
        include('header.php');
        include('../model/datosCaja.php');
        include('../model/datosUsuario.php');
        $misCaja = new misCaja();
        $misUsuarios = new misUsuarios();

        include('../model/datosProducto.php');
        include('../model/datosCategoria.php');
        include('../model/datosProveedor.php');
        $misProducto = new misProducto();
        $misCategoria = new misCategoria();
        $misProveedor = new misProveedor();

    ?>
    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
<!--Aqui empiezan los filtros-->
            <div class="filtros w-75">
                <h4>Filtros:</h4>
                <div class="consultas w-75 gap-0">
                    <form action="../model/accionesCaja.php?accion=filtrar&atributo=reportes"  class="filtro w-100" method="post">
                        <div class="">
                            <label for="stockMinimo" name="stockMinimo" class="form-label">Fitros rápidos:</label>
                        </div>
                        <a href="../model/accionesCaja.php?accion=filtrar&atributo=reportes" type="submit" class="btn btn-success w-75 mt-0" id="reportes" >Filtro Reportes</a>
                    </form>
                    <form action="../model/accionesCaja.php?accion=filtrar&atributo=usuario"  class="filtro w-100" method="post">
                        <div class="">
                            <label for="usuario" class="form-label">Usuario</label>
                            <select name="usuario" id="usuario" class="form-select w-75">
                                <option value="" selected>Ninguno</option>
                                <?php
                                    $respUsuarios = $misUsuarios->verUsuario();
                                    foreach ($respUsuarios as $fila) {
                                        $fila['id_us']?>
                                        <option value=<?php echo $fila['id_us']; ?>><?php echo $fila['nombre_us']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroProveedor" value="Filtro Usuario">
                    </form>
                </div>
            </div>
<!--Aqui terminan los filtros-->
            <div class="categorias mt-1">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>HISTORIAL CAJA</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center">#</th>
                                <th class="text-center">Efectivo Esperado</th>
                                <th class="text-center">Monedas</th>
                                <th class="text-center">Billetes</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Reporte caja</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta="SELECT * FROM caja ORDER BY id_caja DESC";
                                    if(isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                                    $respCaja = $misCaja->verCaja($consulta);
                                    foreach ($respCaja as $fila) { 
                                        $nombreUsuario= $misUsuarios->verUsuarioId($fila['id_usCaja']);
                                        ?>
                                        <tr class="table-light">
                                            <td class="text-center"><?php echo $fila['id_caja']; ?></td>
                                            <td><?php echo '$'.number_format($fila['efectivoesperado_caja']);?></td>
                                            <td><?php echo '$'.number_format($fila['monedas_caja']);?></td>
                                            <td><?php echo '$'.number_format($fila['billetes_caja']);?></td>
                                            <?php 
                                                if($fila['efectivoesperado_caja']!=$fila['total_caja']){
                                                    echo '<td class="text-center"><p class="m-0 campo rojo">$'.number_format($fila['total_caja']).'</p></td>';
                                                } else {
                                                    echo '<td class="text-center"><p class="m-0 campo verde">$'.number_format($fila['total_caja']).'</p></td>';
                                                }
                                            ?>
                                            <td><?php echo $fila['estado_caja']; ?></td>
                                            <td><?php if($fila['descreporte_caja']==null){echo "Ninguna novedad";}else{echo $fila['descreporte_caja'];};?></td>
                                            <td><?php echo $fila['fecha_caja']; ?></td>
                                            <td><?php echo $nombreUsuario[0]['nombre_us']; ?></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>       
        </div>
        <script src="../controller/funcionesCaja.js"></script>
        <script src="../libraries/animaciones.js"></script>
        <?php include('footer.php') ?>


        <?php
    
            } else {
                echo '<script>
                        alert("Error al acceder. La cuenta esta inactiva o el usuario activo no tiene un rol de admin, por lo cual no puede acceder a este apartado")
                    </script>';
            }

        ?>

    </section>
</body>
</html>