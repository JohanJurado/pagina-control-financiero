
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
        include("header.php");
        include("../model/consultas.php");
        include('../model/conexion.php');

        $conexion = new Conexion();
        $consulta = new consultas($conexion); 

        $fecha = $consulta->consultaMultiple("SELECT CURRENT_DATE() as fecha");
        $id_usuario = $consulta->consultaUnica("SELECT id_usCaja as cant FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
        <div class="alert alert-success alert-dismissible fade show p-4 m-5 mb-0" style="font-size: 1.15rem;" role="alert">
            <strong>Bienvenido!</strong> Esta es su ventana principal como empleado, use la barra lateral para navegar en el programa.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="datos">
                <div class="w-100">
                        <div class="cuadro">
                            <div class="img" style="background-color: #4c70bd;"><i class="bi bi-card-list fs-1"></i></div>
                            <div class="texto">
                                <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_ven) as cant FROM venta as v, caja as c WHERE v.id_cajaVenta=id_caja and v.fecha_ven LIKE '".$fecha[0]['fecha']."%' and c.id_usCaja=$id_usuario")) ?></strong></p>
                                <p class="m-0">N° Ventas</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="cuadro">
                            <div class="img" style="background-color: #a970bd;"><i class="bi bi-bar-chart-steps fs-1"></i></div>
                            <div class="texto">
                                <p class="mb-1 fs-3"><strong><?php print "$".number_format($consulta->consultaUnica("SELECT SUM(valortotal_ven) as cant FROM venta WHERE DATE(fecha_ven) = CURRENT_DATE();")+0) ?></strong></p>
                                <p class="m-0">Total Vendido</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="cuadro">
                            <div class="img" style="background-color: #d34a4a;"><i class="bi bi-file-earmark-person fs-1"></i></div>
                            <div class="texto">
                                <p class="mb-1 fs-3"><strong><?php print "$".(number_format($consulta->consultaUnica('SELECT SUM(`total_gasto`) as cant FROM gasto WHERE DATE(`fecha_gasto`) = CURRENT_DATE();')+0)) ?></strong></p>
                                <p class="m-0">Total Gastos</p>
                            </div>
                        </div>
                    </div>
                </div> 
            <div class="datos pt-2">
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img verde"><i class="bi bi-bag-plus-fill fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_VP) as cant FROM `ventaprod` as vp, venta as v WHERE vp.id_venVP=v.id_ven and v.fecha_ven LIKE '".$fecha[0]['fecha']."%';")) ?></strong></p>
                            <p class="m-0">Productos Vendidos</p>
                        </div>
                    </div>
                    <a href="./producto.php" class="btn w-100 mt-2" style="background-color: #A3C86D; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Productos</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img naranja"><i class="bi bi-cart4 fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_ven) as cant FROM venta WHERE fecha_ven LIKE '".$fecha[0]['fecha']."%'")) ?></strong></p>
                            <p class="m-0">Ventas Diarias</p>
                        </div>
                    </div>
                    <a href="./addVentas.php" class="btn w-100 mt-2" style="background-color: #FF7857; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Crear una nueva Venta</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img azul"><i class="bi bi-cart-dash-fill fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_gasto) as cant FROM gasto WHERE fecha_gasto LIKE '".$fecha[0]['fecha']."%' and tipo_gasto='otro'")) ?></strong></p>
                            <p class="m-0">Gastos Diarios</p>
                        </div>
                    </div>
                    <a href="./addGastos.php" class="btn w-100 mt-2" style="background-color: #7ACBEE; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Añadir un nuevo Gasto</a>
                </div>
            </div>
        </div>
    </section>
        <script src="../libraries/animaciones.js"></script>
        <?php include('footer.php') ?>
  </body>
</html>

