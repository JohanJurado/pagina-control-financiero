<?php
    include('header.php');
    include('../model/datosProducto.php');
    include('../model/datosCategoria.php');
    include('../model/datosProveedor.php');
    $misProducto = new misProducto();
    $misCategoria = new misCategoria();
    $misProveedor = new misProveedor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jorvan Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">

    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>
<section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto d-flex justify-content-center">
            <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>AGREGAR PRODUCTO</h6>
                    </div>
                    <form class="body" enctype="multipart/form-data">
                        <input type="text" class="form-control" placeholder="Nombre del Producto" id="nombre_prod" name="nombre_prod">
                        <textarea placeholder="Descripcion del Producto" id="descripcion_prod" name="descripcion_prod" class="form-control"></textarea>
                        <input type="text" class="form-control" placeholder="Costo del Producto" id="costo_prod" name="costo_prod">
                        <input type="text" class="form-control" placeholder="Precio Venta del Producto" id="valorganancia_prod" name="valorganancia_prod">
                        <input type="number" placeholder="Stock del Producto" id="stock_prod" name="stock_prod" min="0" max="99999" class="form-control">
                        <input type="number" class="form-control" placeholder="Stock minimo del Producto" id="stockMin_prod" name="stockMin_prod" min="0" max="99999">
                        <!--<input type="text" placeholder="Importancia del Producto" id="importancia_prod" name="importancia_prod">--> 
                        <!-- Combo categoria -->
                        <select name="id_catProd" id="id_catProd" class="form-control">
                            <option value="" selected>Categoria Producto</option>
                            <?php 
                            $respCat=$misCategoria->verCategoria();
                            foreach($respCat as $fila){ ?>
                            <option value="<?php echo $fila['id_cat'] ?>"><?php echo $fila['nombre_cat'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- Combo proveedor -->
                        <select name="id_provProd" id="id_provProd" class="form-control">
                            <option value="" selected>Proveedor Producto</option>
                            <?php 
                            $respProv=$misProveedor->verProveedor();
                            foreach($respProv as $fila){ 
                                if($fila['id_prov']!=1){  ?>
                                    <option value="<?php echo $fila['id_prov'] ?>"><?php echo $fila['nombre_prov'] ?></option>
                            <?php
                            }}
                            ?>
                        </select>
                        <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/*" value="">
                        <div class="d-flex gap-3 mt-1">
                            <input type="button" class="btn btn2" id="registrarProducto" value="Agregar Producto" placeholder="Agregar Producto" required>
                            <a type="button" href="./producto.php" class="btn btn-dark">Ver Productos</a>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
        <script src="../controller/funcionesProducto.js"></script>
        <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>    
</body>
</html>