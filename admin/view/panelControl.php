
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
        include("header.php");
        include("../model/consultas.php");
        include('../model/conexion.php');

        $conexion = new Conexion();
        $consulta = new consultas($conexion); 

        $fecha = $consulta->consultaMultiple("SELECT CURRENT_DATE() as fecha");
    ?>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
        <div class="alert alert-success alert-dismissible fade show p-4 m-5 mb-0" style="font-size: 1.15rem;" role="alert">
            <strong>Bienvenido!</strong> Esta es su ventana principal, use la barra lateral para navegar en el programa.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            <div class="datos">
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img verde"><i class="bi bi-file-earmark-person fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica('SELECT count(id_prov) as cant FROM proveedor')) ?></strong></p>
                            <p class="m-0">Proveedores</p>
                        </div>
                    </div>
                    <a href="./proveedores.php" class="btn w-100 mt-2" style="background-color: #A3C86D; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Proveedores</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img naranja"><i class="bi bi-cart4 fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_ven) as cant FROM venta WHERE fecha_ven LIKE '".$fecha[0]['fecha']."%'")) ?></strong></p>
                            <p class="m-0">Ventas Diarias</p>
                        </div>
                    </div>
                    <a href="./ventas.php" class="btn w-100 mt-2" style="background-color: #FF7857; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Ventas</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img azul"><i class="bi bi-bag-plus-fill fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_gasto) as cant FROM gasto WHERE fecha_gasto LIKE '".$fecha[0]['fecha']."%' and tipo_gasto='otro'")) ?></strong></p>
                            <p class="m-0">Gastos Diarios</p>
                        </div>
                    </div>
                    <a href="./gastos.php" class="btn w-100 mt-2" style="background-color: #7ACBEE; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Gastos</a>
                </div>
            </div>  
        </div>
    </section>
        <script src="../libraries/animaciones.js"></script>
        <?php include('footer.php') ?>
  </body>
</html>

