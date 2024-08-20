<?php
include('header.php');
include('../model/datosProducto.php');
include('../model/datosCategoria.php');
include('../model/datosVentaprod.php');
include('../model/datosCaja.php');
include('../model/consultas.php');
include('../model/conexion.php');

$misCaja = new misCaja();
$misProducto = new misProducto();
$misCategoria = new misCategoria();
$misVentaprod = new misVentaprod();
$conexion = new Conexion();
$consultas = new consultas($conexion);

$consulta_id_caja = "SELECT max(id_caja) as id_caja FROM caja;";
$id_caja = $consultas->consultaMultiple($consulta_id_caja);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STOCKMASTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <script>
        function redireccionAddVenta(url) {
            if (confirm("¿Esta seguro que desea salir de la venta? Se eliminaran los productos agregados recientemente")) {
                $(document).ready(function() {
                    $("#eliminarVenta").click();
                });
                self.location = url;
            }
        }

        function mayorista(numProd) {
            let nombreId="precioVentaMayConfirm_VP"+numProd;
            let confirmar = document.getElementById(nombreId);
            if (confirm("Esta seguro que desea añadir este producto con su precio de venta 'Al Mayor'?")) {
                confirmar.value = "Si";
                $(document).ready(function() {
                    $("#registrarVentaProd"+numProd).click();
                });
            }
        }
    </script>
    
    <section class="contenido">
        <div class="barraHorizontal overflow-auto">
            <button class="option panel" onclick="redireccionAddVenta('panelControl.php')">
                <i class="bi bi-house-gear-fill fs-5"></i>
                <p class="m-0">Panel de control</p>
            </button>

            <div class="option productos text-decoration-none">
                <i class="bi bi-bag-plus-fill fs-5"></i>
                <p class="m-0">Productos</p>
            </div>
            <button class="option sub d-none administrarProductos text-decoration-none" onclick="redireccionAddVenta('producto.php')">
                <i class="bi bi-arrow-return-right"></i>
                <p class="m-0">Administrar Productos</p>
            </button>

            <div class="option ventas text-decoration-none">
                <i class="bi bi-cart4 fs-5"></i>
                <p class="m-0">Ventas</p>
            </div>
            <button class="option sub d-none anadirVentas text-decoration-none" onclick="redireccionAddVenta('addVentas.php')">
                <i class="bi bi-arrow-return-right"></i>
                <p class="m-0">Añadir Ventas</p>
            </button>

            <div class="option gastos text-decoration-none">
                <i class="bi bi-cart-dash-fill fs-5"></i>
                <p class="m-0">Gastos</p>
            </div>
            <button class="option sub d-none anadirGastos text-decoration-none" onclick="redireccionAddVenta('addGastos.php')">
                <i class="bi bi-arrow-return-right"></i>
                <p class="m-0">Añadir Gastos</p>
            </button>
        </div>
        <div class="interfaz overflow-auto">
            <div class="filtros">
                <h4>Nueva Factura:</h4>
                <div class="consultas">
                    <form class="filtro d-flex gap-4" enctype="multipart/form-data">
                        <div class="w-50">
                            <label class="form-label">Agregar Producto:</label>
                            <button class="btn agg btn-primary w-100 d-flex justify-content-center align-items-center gap-2 pt-2 pb-2" data-bs-toggle="modal" type="button" data-bs-target="#exampleModal">
                                <i class="bi bi-cart-plus d-flex align-items-center"></i>
                                <p class="m-0">Agregar</p>
                            </button>
                        </div>
                        <?php

                        $consultaId = "SELECT max(id_ven) as id FROM venta";
                        $respId = $misVentaprod->verVentaprod($consultaId);

                        $consultaTotalVenta = "SELECT sum(total_VP) as total FROM `ventaprod` WHERE `id_venVP`=(SELECT max(id_ven) FROM venta)";
                        $respTotalVenta = $misVentaprod->verVentaprod($consultaTotalVenta);

                        $consultaCantidadProductos = "SELECT sum(cantidad_VP) as cantidad FROM `ventaprod` WHERE `id_venVP`=(SELECT max(id_ven) FROM venta)";
                        $respCantidadProductos = $misVentaprod->verVentaprod($consultaCantidadProductos);

                        ?>
                        <div class="w-50">
                            <label class="form-label">Valor total Factura:</label>
                            <p class="form-control m-0">$ <?php echo number_format($respTotalVenta[0]['total']+0); ?></p>
                        </div>
                        <div class="w-50">
                            <label class="form-label">Productos Totales:</label>
                            <p class="form-control m-0"><?php echo $respCantidadProductos[0]['cantidad']+0; ?> Productos</p>
                        </div>
                        <div class="w-50">
                            <label class="form-label">Método Pago:</label>
                            <select name="metodopago_ven" id="metodopago_ven" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>

                        <!--Datos Implicitos-->
                        <input type="number" id="id_ven" class="d-none" value="<?php echo $respId[0]['id']; ?>">
                        <input type="number" name="valortotal_ven" id="valortotal_ven" class="d-none" value="<?php echo $respTotalVenta[0]['total']; ?>">
                        <input type="text" name="id_cajaVenta" id="id_cajaVenta" class="d-none" value="<?php echo $id_caja[0]['id_caja']; ?>">

                        <!--Boton Actualizar Ventas-->
                        <div class="w-50 d-flex align-items-end">
                            <input type="button" class="btn btn-success w-100" id="registrarVenta" value="Crear Factura">
                        </div>
                        <div class="w-50 d-flex align-items-end">
                            <button type="button" class="btn btn-danger w-100" onclick="redireccionAddVenta('')">Borrar Factura</button>
                            <button id="eliminarVenta" class="d-none"></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="categorias mt-2">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>LISTA DE PRODUCTOS</h6>
                    </div>
                    <div class="body mb-3">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Precio Unidad</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio Total</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Acciones</th>
                            </thead>
                            <tbody>
                                <?php
                                $consulta = "SELECT * FROM `ventaprod` WHERE `id_venVP`=(SELECT max(id_ven) FROM venta)";
                                if (isset($_GET['consulta'])) {
                                    $consulta = $_GET['consulta'];
                                }
                                $respVentaprod = $misVentaprod->verVentaprod($consulta);
                                foreach ($respVentaprod as $fila) {
                                    // llamado a los atributos del producto
                                    $respProducto = $misProducto->verProductoId($fila['id_prodVP']);

                                    // llamado nombre categoria
                                    $nombreCategoria = $misCategoria->verCategoriaId($respProducto[0]['id_catProd']);

                                ?>
                                    <tr class="table-light">
                                        <td><?php echo $respProducto[0]['nombre_prod']; ?></td>
                                        <td><?php echo $respProducto[0]['descripcion_prod']; ?></td>
                                        <td class="text-center"><?php echo $nombreCategoria[0]['nombre_cat']; ?></td>
                                        <td class="text-center">$<?php echo number_format($fila['precioventa_VP']); ?></td>
                                        <td class="text-center"><?php echo $fila['cantidad_VP']; ?></td>
                                        <td class="text-center">$<?php echo number_format($fila['total_VP']); ?></td>
                                        <td>
                                            <center><img height="50px" src="<?php echo ($respProducto[0]['imagen']); ?>" /></center>
                                        </td>
                                        <td>
                                            <center><a href="../model/accionesVentaprod.php?accion=eliminar&id_VP=<?php echo $fila['id_VP']; ?>" type="button" class="btn btn-danger">Eliminar</a>
                                        </td>
                                        </center>
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

        <!-- Modal -->
        <div class="modal" id="exampleModal" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Agregar Producto:</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" style="background-color: #F1F2F7;">
                        <div class="filtros p-3">
                            <h4>Filtros:</h4>
                            <div class="consultas">
                                <form class="filtro d-flex gap-4" enctype="multipart/form-data">
                                    <div class="w-100">
                                        <label for="nombreProducto" class="form-label">Nombre producto:</label>
                                        <input type="text" list="nombreproducto" name="nombreProducto" id="nombreProducto" class="form-control w-100" value="Ninguno">
                                        <datalist id="nombreproducto">
                                            <?php
                                            $respNombreProducto = $misProducto->verProducto("SELECT * FROM producto");
                                            foreach ($respNombreProducto as $fila) { ?>
                                                <option value="<?php echo $fila['nombre_prod'] ?>"></option>
                                            <?php } ?>
                                        </datalist>
                                    </div>
                                    <div class="w-100">
                                        <label for="categoria" class="form-label">Categoría:</label>
                                        <select name="categoria" id="categoria" class="form-select w-100">
                                            <option value="Ninguno" selected>Ninguno</option>
                                            <?php
                                            $respCategoria = $misCategoria->verCategoria();
                                            foreach ($respCategoria as $fila) { ?>
                                                <option value=<?php echo $fila['id_cat']; ?>><?php echo $fila['nombre_cat']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="w-100 d-flex align-items-end">
                                        <input type="button" class="btn btn-success w-100" id="buscarProducto" value="Realizar Búsqueda">
                                    </div>
                                </form>
                            </div>
                            <div class="categorias p-0">
                                <div class="tabla f-2">
                                    <div class="head align-items-center">
                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                        <h6>PRODUCTOS ENCONTRADOS</h6>
                                    </div>
                                    <div class="body">
                                        <table class="table" border="1px">
                                            <thead class="table-default">
                                                <th class="text-center" style="width: 5rem">Nombre Producto</th>
                                                <th class="text-center" style="width: 3rem; align-content: center">Cantidad</th>
                                                <th class="text-center" style="width: 6rem">Precio Venta</th>
                                                <th class="text-center" style="width: 6rem">Precio Mayor</th>
                                                <th class="text-center" style="width: 2rem; align-content: center">Stock</th>
                                                <th class="text-center" style="width: 1rem; align-content: center">Categoría</th>
                                                <th class="text-center" style="width: 2rem; align-content: center">Añadir Producto</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $busqueda = "SELECT * FROM producto";
                                                if (isset($_GET['busqueda'])) {
                                                    $busqueda = $_GET['busqueda'];
                                                }
                                                $respProducto = $misProducto->verProducto($busqueda);
                                                $cont=0;
                                                foreach ($respProducto as $fila) {
                                                    $cont++;
                                                    $nombreCategoria = $misCategoria->verCategoriaId($fila['id_catProd']);
                                                    $precio_venta = round(($fila['valorganancia_prod']/$fila['gananciainicial_prod'])*100);
                                                    $precio_ventaMay = round(($fila['valorgananciamay_prod']/$fila['gananciainicialmay_prod'])*100);
                                                ?>
                                                    <tr class="table-light">
                                                        <form action="../model/accionesVentaprod.php?accion=registrar" method="post" enctype="multipart/form-data">
                                                            <?php
                                                            $consulta = "SELECT max(id_ven) as id FROM venta";
                                                            $respVentaprod = $misVentaprod->verVentaprod($consulta);
                                                            ?>
                                                            <!--Datos implicitos-->
                                                            <td class="d-none"><input type="text" id="id_venVP" name="id_venVP" class="d-none" value="<?php echo $respVentaprod[0]['id'] ?>"></td>
                                                            <td class="d-none"><input type="text" id="id_prodVP" name="id_prodVP" value="<?php echo $fila['id_prod'] ?>"></td>

                                                            <td class="d-none"><input type="text" id="costo_prod" name="costo_prod" value="<?php echo $fila['costo_prod']; ?>"></td>
                                                            <td class="d-none"><input type="text" id="stock_prod" name="stock_prod" value="<?php echo $fila['stock_prod']; ?>"></td>
                                                            <td class="d-none"><input type="text" id="precioVentaMayConfirm_VP<?php echo $cont ?>" name="precioVentaMayConfirm_VP" value="No"></td>

                                                            <!--Datos explicitos-->
                                                            <td class="text-center align-middle"><center><?php echo $fila['nombre_prod']; ?><center></td>
                                                            <td class="text-center" style="align-content: center">
                                                                <input type="text" name="cantidad_VP" class="form-control" value="1">
                                                            </td>
                                                            <td class="text-center" style="align-content: center">
                                                                <input type="number" name="precioVenta_VP" class="form-control" value="<?php echo $precio_venta; ?>" readonly>
                                                            </td>
                                                            <td class="text-center" style="align-content: center">
                                                                <input type="number" name="precioVentaMay_VP" class="form-control" value="<?php echo $precio_ventaMay; ?>" readonly>
                                                            </td>
                                                            <td class="text-center align-middle"><center><?php echo $fila['stock_prod']; ?></center></td>
                                                            <td class="text-center align-middle"><center><?php echo $nombreCategoria[0]['nombre_cat']; ?></center></td>
                                                            <td>
                                                                <center>
                                                                    <input type="submit" id="registrarVentaProd<?php echo $cont ?>" class="btn btn-success pt-1 mb-2" value="Default">
                                                                    <button type="button" onclick="mayorista(<?php echo $cont ?>)" class="btn btn-primary">Al Mayor</button>
                                                                <center>
                                                            </td>
                                                        </form>
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
                    </div>
                </div>
            </div>
        </div>

        <script src="../controller/funcionesVentaprod.js"></script>
        <script src="../controller/funcionesVentas.js"></script>
        <script src="../controller/funcionesProducto.js"></script>
        <script src="../libraries/animaciones.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            iniciarPagina();
            pagVentas();
            <?php 
            
                if (isset($_GET['stock'])){?>
                    alert("La cantidad ingresada supera el stock actual del producto");
                    self.location="addVentas.php";
            <?php
                }

                if (isset($_GET['campo'])){?>
                    alert("Los campos CANTIDAD y PRECIO VENTA no pueden estar vacios");
                    self.location="addVentas.php";
            <?php
                }
            ?>
        });
        </script>


        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == "Si") { ?>
                <script>
                    $(document).ready(function() {
                        $(".agg").click();
                    });
                </script>
        <?php
            }
        }
        ?>
</body>

</html>