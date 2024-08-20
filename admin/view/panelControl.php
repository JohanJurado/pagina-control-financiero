
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
        include("../model/consultas.php");
        include('../model/conexion.php');

        $conexion = new Conexion();
        $consulta = new consultas($conexion); 

        $fecha = $consulta->consultaMultiple("SELECT CURRENT_DATE() as fecha");

        $consultaCaja = $consulta->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
        $estadoCaja = $consultaCaja[0]['estado_caja'];
        $usuarioCaja = $consultaCaja[0]['id_usCaja'];
    
        if ($estadoCaja!="Cerrada" && $usuarioCaja==1){
        include("header.php");

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
                        <div class="img" style="background-color: #8cad5c;"><i class="bi bi-bag-plus-fill fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_VP) as cant FROM `ventaprod` as vp, venta as v WHERE vp.id_venVP=v.id_ven and v.fecha_ven LIKE '".$fecha[0]['fecha']."%';")) ?></strong></p>
                            <p class="m-0">Productos Vendidos</p>
                        </div>
                    </div>
                    <a href="./producto.php" class="btn w-100 mt-2 boton" style="background-color: #8cad5c; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Productos</a>
                    <a href="./addProducto.php" class="btn w-100 mt-2 boton" style="background-color: #8cad5c; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Añadir un nuevo Producto</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img" style="background-color: #f76e4c;"><i class="bi bi-cart4 fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_ven) as cant FROM venta WHERE fecha_ven LIKE '".$fecha[0]['fecha']."%'")) ?></strong></p>
                            <p class="m-0">Ventas Diarias</p>
                        </div>
                    </div>
                    <a href="./ventas.php" class="btn w-100 mt-2 boton" style="background-color: #f76e4c; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Ventas</a>
                    <a href="./addVentas.php" class="btn w-100 mt-2 boton" style="background-color: #f76e4c; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Añadir una nueva Venta</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img" style="background-color: #70bedf;"><i class="bi bi-cart-dash-fill fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_gasto) as cant FROM gasto WHERE fecha_gasto LIKE '".$fecha[0]['fecha']."%' and tipo_gasto='otro'")) ?></strong></p>
                            <p class="m-0">Gastos Diarios</p>
                        </div>
                    </div>
                    <a href="./gastos.php" class="btn w-100 mt-2 boton" style="background-color: #70bedf; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Gastos</a>
                    <a href="./addGastos.php" class="btn w-100 mt-2 boton" style="background-color: #70bedf; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Añadir un nuevo Gasto</a>
                </div>
            </div>  
            <div class="datos pt-2">
            <div class="w-100">
                    <div class="cuadro">
                        <div class="img" style="background-color: #4c70bd;"><i class="bi bi-card-list fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_fac) as cant FROM factura WHERE estado_fac='Pendiente'")) ?></strong></p>
                            <p class="m-0">Facturas Pendientes</p>
                        </div>
                    </div>
                    <a href="./facturas.php" class="btn w-100 mt-2 boton" style="background-color: #4c70bd; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Facturas</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img" style="background-color: #a970bd;"><i class="bi bi-bar-chart-steps fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica("SELECT count(id_cat) as cant FROM `categoria`")) ?></strong></p>
                            <p class="m-0">Categorías</p>
                        </div>
                    </div>
                    <a href="./categorias.php" class="btn w-100 mt-2 boton" style="background-color: #a970bd; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Categorías</a>
                </div>
                <div class="w-100">
                    <div class="cuadro">
                        <div class="img" style="background-color: #d34a4a;"><i class="bi bi-file-earmark-person fs-1"></i></div>
                        <div class="texto">
                            <p class="mb-1 fs-3"><strong><?php print($consulta->consultaUnica('SELECT count(id_prov) as cant FROM proveedor')-1) ?></strong></p>
                            <p class="m-0">Proveedores</p>
                        </div>
                    </div>
                    <a href="./proveedores.php" class="btn w-100 mt-2 boton" style="background-color: #d34a4a; color: white; font-weight: 600; padding: 1rem; font-size: 1.2rem;">Ir a Proveedores</a>
                </div>
            </div>
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

