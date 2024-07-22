<?php
    use Dompdf\Dompdf;

    include("../model/conexion.php");
    include("../model/consultas.php");
    $conexion = new conexion();
    $consultas = new consultas($conexion);

    $consultaCaja = $consultas->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    $estadoCaja = $consultaCaja[0]['estado_caja'];
    $usuarioCaja = $consultaCaja[0]['id_usCaja'];

    if ($estadoCaja!="Cerrada" && $usuarioCaja==1){
        ob_start();
?>


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

        if ($_POST['formato']!=""){
            $formato=$_POST['formato'];
            if (isset($_GET['tipo'])){
                if ($_GET['tipo']=="porFecha"){
                    $fechaInicio = $_POST['fechaInicio'];
                    $fechaFin = $_POST['fechaFin'];
        
                    if ($fechaInicio=="" && $fechaFin==""){
                        $valor="";
                    } else if ($fechaInicio==""){
                        $fechaInicio=$fechaFin;
                    } else if ($fechaFin=="") {
                        $fechaFin=$fechaInicio;
                    }

                    $fecha="and v.fecha_ven BETWEEN '$fechaInicio 00:00:00' and '$fechaFin 23:59:59'";

                    $pdf=$fechaInicio."_al_".$fechaFin;
    
                    $descripcion="Días del $fechaInicio al $fechaFin";
                } elseif ($_GET['tipo']=="porDia"){
                    $dia = $_POST['dia'];
        
                    $fecha="and v.fecha_ven like '$dia%'";
                    
                    $pdf = "$dia";
    
                    $descripcion="Día $dia";
                }  elseif ($_GET['tipo']=="porMes"){
                    $mes = $_POST['mes'];
                    $anio = $_POST['anio'];
        
                    $fecha="$anio$mes";

                    $pdf = "$anio$mes";
        
                    $fecha="and v.fecha_ven like '$fecha%'";

                    $descripcion="Mes $anio$mes";
                }
            } else {
                echo '<script>
                        alert("No se puede acceder al reporte por url");
                        self.location="panelControl.php";
                    </script>';
            }

            if (isset($_POST['categoria'])){
                if ($_POST['categoria']=="Ninguna"){
                    $idcat_consultaProductos="";
                    $idcat_consultaReportes="";
                    $nombreCategoria="";
                } else {
                    $id_cat=$_POST['categoria'];
                    $nombreCategoria=$consultas->consultaMultiple("SELECT nombre_cat as nombre FROM categoria WHERE id_cat=$id_cat");
                    $nombreCategoria=$nombreCategoria[0]['nombre'];
                    $idcat_consultaProductos = "and c.id_cat=".$_POST['categoria'];
                    $idcat_consultaReportes="and id_cat=".$_POST['categoria'].";";
                }
            } else {
                echo '<script>
                        alert("No se puede acceder al reporte por url");
                        self.location="panelControl.php";
                    </script>';
            }
        } else {
            echo '<script>
                        alert("No se especifico un formato");
                        self.location="panelControl.php";
                     </script>';
        }

        $consultaReportes="SELECT sum(p.costo_prod) as 'totalInvertido', sum(vp.cantidad_VP) as 'cantidadProductos', sum(vp.total_VP) as 'totalVentas' FROM ventaprod as vp, venta as v, producto as p, categoria as c WHERE c.id_cat=p.id_catProd and p.id_prod=vp.id_prodVP and v.id_ven=vp.id_venVP $fecha $idcat_consultaReportes;";

        $reportes = $consultas->consultaMultiple($consultaReportes);
    ?>
    <section class="header">
        <div class="nombre">
            <p class="m-0">JORVAN - INVENTORY</p>
        </div>
        <div class="fecha">
            <p>Rango del Reporte: <?php echo $descripcion; ?> </p>
            <div class="d-flex gap-5 align-items-center">
                <p class="pb-0 mb-0">Generado el <?php date_default_timezone_set('America/Bogota'); echo date("d/m/Y g:i a");?></p>
                <?php if($formato!="pdf"){?>
                    <a href="fechaReporte.php?reporte=ventas&tipo=<?php echo $_GET['tipo'] ?>" class="btn btn-secondary me-5">Regresar</a>
                <?php }?>
            </div>
        </div>
    </section>
    <section class="contenido">
        <div class="flex-100 overflow-auto">
            <div class="filtros">
                <form action="reporteGanancias.php?tipo=<? echo $_GET['tipo'] ?>" class="filtro d-flex flex-column w-100 gap-3" method="post" enctype="multipart/form-data">
                    <h4>Reporte de Ventas: </h4>
                    <div class="d-flex gap-4 align-items-end w-75">
                        <div class="w-75">
                            <label for="inversion" class="form-label">Total Inversion: </label>
                            <input type="text" id="inversion" class="form-control h-auto fw-600" value="$<?php echo number_format($reportes[0]['totalInvertido']+0) ?>" readonly>
                        </div>
                        <div class="w-75">
                            <label for="cantidad" class="form-label">Productos Vendidos: </label>
                            <input type="text" id="cantidad" class="form-control h-auto fw-600" value="<?php echo $reportes[0]['cantidadProductos']+0 ?> Productos" readonly>
                        </div>
                        <div class="w-75">
                            <label for="total" class="form-label">Total Ventas: </label>
                            <input type="text" id="total" class="form-control h-auto fw-600" value="$<?php echo number_format($reportes[0]['totalVentas']+0) ?>" readonly>
                        </div>
                    </div>
                </form>
            </div>

            <div class="categorias overflow-auto m-0">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6 class="mb-1">LISTA DE PRODUCTOS: </h6>
                        <p class="mb-0 fw-600 campo verde"><?php $categoria = $_POST['categoria']=="Ninguna"? "Todas las Categorias" : $nombreCategoria; echo $categoria ?></p>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center" style="width: 1.5rem">#</th>
                                <th class="text-center" style="width: 3rem">Producto</th>
                                <th class="text-center" style="width: 5.5rem">Cantidad</th>
                                <th class="text-center" style="width: 5.5rem">Ganancia</th>
                                <th class="text-center" style="width: 5rem">Total Invertido</th>
                                <th class="text-center" style="width: 5rem">Total Vendido</th>
                                <th  class="text-center" style="width: 5rem">Ganancia Total</th>
                                <th class="text-center" style="width: 3.5rem">Imagen</th>
                            </thead>
                            <tbody>
                                <?php

                                    $respFactura = $consultas->consultaMultiple("SELECT vp.id_prodVP as 'id', p.nombre_prod as 'nombreProducto', sum(vp.cantidad_VP) as 'cantidadProductos', (sum(vp.ganancia_VP)/ count(vp.id_prodVP)) as 'gananciaPromedio', sum(p.costo_prod) as 'totalInvertido', sum(vp.total_VP) AS 'totalVendido', (sum(vp.valorganancia_VP)*vp.cantidad_VP) as 'gananciaTotal', p.imagen as 'imagen' FROM ventaprod as vp, venta as v, producto as p, categoria as c WHERE c.id_cat=p.id_catProd and p.id_prod=vp.id_prodVP and v.id_ven=vp.id_venVP $fecha $idcat_consultaProductos GROUP BY id_prodVP ORDER BY sum(cantidad_VP) DESC;");

                                    foreach ($respFactura as $fila) {?>
                                            <tr class="table-light">
                                                <td class="text-center"><?php echo $fila['id']; ?></td>
                                                <td class="text-center"><?php echo $fila['nombreProducto']; ?></td>
                                                <td class="text-center"><?php echo $fila['cantidadProductos']; ?></td>
                                                <td class="text-center"><?php echo round($fila['gananciaPromedio']); ?>%</td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['totalInvertido']); ?></td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['totalVendido']); ?></td>
                                                <td class="text-center"><?php echo '$'.number_format($fila['gananciaTotal']); ?></td>
                                                <td class="text-center"><img style="max-width: 5rem" src="<?php echo "http://".$_SERVER['HTTP_HOST']."/jorvan/project/pagina-control-financiero/admin/view/".$fila['imagen']; ?>" alt="Imagen Producto" class="w-50"></td>
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
        
    </section>
    <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>
  </body>
</html>

<?php 

    $html=ob_get_clean();

    include("../libraries/dompdf/autoload.inc.php");

    if ($formato=="web"){
        echo $html;
    } else {
    
        $dompdf = new Dompdf();
    
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled'=> true));
        $dompdf->setOptions($options);
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('letter');
        //$dompdf->setPaper('A4', 'landscape');
    
        $dompdf->render();
    
        $dompdf->stream("reporteVentas_$pdf.pdf", array("Attachment" => false));
        
    }

        
    } else {
        echo '<script>
                alert("Error al acceder. La cuenta esta inactiva o el usuario activo no tiene un rol de admin, por lo cual no puede acceder a este apartado")
            </script>';
    }

?>

