<?php
include ("../../model/datosProducto.php");
include("../../model/datosCategoria.php");
include("../../model/datosProveedor.php");
$misProducto = new misProducto();
$misCategoria = new misCategoria();
$misProveedor = new misProveedor();
include("header.php");
// Validaciones de envio de variable
if(isset($_GET['id_prod'])) { // la variable se trae desde el navegador
  $id_prod = $_GET['id_prod'];
  // Buscamos el curso a modificar o eliminar
  $respProducto = $misProducto->verProductoId($id_prod);
  // Asignamos el resultado de la búsqueda
  if(count($respProducto) > 0) {
    $id_prod = $respProducto[0]['id_prod'];
    $nombre_prod = $respProducto[0]['nombre_prod'];
    $descripcion_prod = $respProducto[0]['descripcion_prod'];
    $costo_prod=$respProducto[0]['costo_prod'];
    $gananciainicial_prod=$respProducto[0]['gananciainicial_prod'];
    $gananciainicialmay_prod=$respProducto[0]['gananciainicialmay_prod'];
    $valorganancia_prod=$respProducto[0]['valorganancia_prod'];
    $valorgananciamay_prod=$respProducto[0]['valorgananciamay_prod'];
    $stock_prod=$respProducto[0]['stock_prod'];
    $stockMin_prod=$respProducto[0]['stockMin_prod'];
    $importancia_prod=$respProducto[0]['importancia_prod'];
    $id_catProd=$respProducto[0]['id_catProd'];
    $id_provProd=$respProducto[0]['id_provProd'];
    $imagen=$respProducto[0]['imagen'];

    $precioVenta=round(($valorganancia_prod/$gananciainicial_prod)*100);
    $precioVentaMay=round(($valorgananciamay_prod/$gananciainicialmay_prod)*100);

    $respCategoria= $misCategoria->verCategoriaId($id_catProd);
    $nombre_cat = $respCategoria[0]['nombre_cat'];

    $respProveedor=$misProveedor->verProveedorId($id_provProd);
    $nombre_prov = $respProveedor[0]['nombre_prov'];

  } else {
    echo '<script>
        alert ("El producto seleccionado no fue encontrada.")
        self.location="../producto.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar un producto")
        self.location="../producto.php"
        </script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../libraries/style.css">

    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
  <body>
<section class="contenido">
    <?php include('barraHorizontalEdit.php') ?>
    <div class="interfaz overflow-auto d-flex justify-content-center">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>EDITAR PRODUCTO</h6>
                    </div>
                    <form class="body" enctype="multipart/form-data">
                        <div>
                            <label for="id_prod" class="form-label">Id producto:</label>
                            <input class="form-control" type="text" id="id_prod" name="id_prod" readonly value="<?php echo $id_prod; ?>">
                        </div>
                        <div>
                            <label for="nombre_prod" class="form-label">Nombre producto:</label>
                            <input class="form-control" type="text" id="nombre_prod" name="nombre_prod" value="<?php echo $nombre_prod; ?>">
                        </div>
                        <div>
                            <label for="descripcion_prod" class="form-label">Descripcion producto:</label>
                            <input class="form-control" type="text" id="descripcion_prod" name="descripcion_prod" value="<?php echo $descripcion_prod;?>">
                        </div>
                        <div>
                            <label for="costo_prod" class="form-label">Costo producto:</label>
                            <input class="form-control" type="text" id="costo_prod" name="costo_prod" value="<?php echo $costo_prod; ?>">
                        </div>
                        <div>
                            <label for="gananciainicial_prod" class="form-label">Precio Venta:</label>
                            <input class="form-control" type="text" id="valorganancia_prod" name="valorganancia_prod" value="<?php echo $precioVenta; ?>">
                        </div>
                        <div>
                            <label for="gananciainicial_prod" class="form-label">Precio Venta Mayorista:</label>
                            <input class="form-control" type="text" id="valorgananciamay_prod" name="valorgananciamay_prod" value="<?php echo $precioVentaMay; ?>">
                        </div>
                        <div>
                            <label for="stock_prod" class="form-label">Stock:</label>
                            <input class="form-control" type="number" id="stock_prod" name="stock_prod" value="<?php echo $stock_prod; ?>" min="0" max="99999">
                        </div>
                        <div>
                            <label for="stockMin_prod" class="form-label">Stock Minimo:</label>
                            <input class="form-control" type="number" id="stockMin_prod" name="stockMin_prod" value="<?php echo $stockMin_prod; ?>" min="0" max="99999">
                        </div>
                            <input class="form-control d-none" type="text" id="importancia_prod" name="importancia_prod" value="<?php echo $importancia_prod; ?>">
                        <div>
                            <label for="id_catProd" class="form-label">Categoria Producto:</label>
                            <!--Combo categoria-->
                            <select id="id_catProd" name="id_catProd" class="form-select">
                                <option value="" disabled selected>Categoria Producto</option>
                                <option value="<?php echo $id_catProd;?>" selected><?php echo $nombre_cat; ?></option>
                                <?php
                                $respCat=$misCategoria->verCategoria();                            
                                foreach($respCat as $fila){
                                    if($id_catProd!=$fila['id_cat']){?>
                                <option value="<?php echo $fila['id_cat']; ?>"><?php echo $fila['nombre_cat'] ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="id_provProd" class="form-label">Proveedor:</label>
                            <!--Combo proveedor-->
                            <select id="id_provProd" name="id_provProd" class="form-select">
                                <option value="" disabled selected>Proveedor Producto:</option>
                                <option value="<?php echo $id_provProd;?>" selected><?php echo $nombre_prov;?></option>
                                <?php
                                $respProv=$misProveedor->verProveedor();
                                foreach($respProv as $fila){
                                    if($id_provProd!=$fila['id_prov'] && $fila['id_prov']!=1){?>

                                <option value="<?php echo $fila['id_prov']; ?>"><?php echo $fila['nombre_prov'] ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Imagen actual:</label>
                            <div>
                                <?php $respImagen = $misProducto->verProductoId($id_prod);?>
                                <img height="50px" src="<?php echo ('../'.$imagen);?>"/>
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label">Imagen a actualizar:</label>
                            <input type="file" name="imagen" id="imagen" value="" accept="image/*">
                        <div>
                            <label for="" class="form-label"></label>
                            <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="editarProducto" value="Editar">
                            <input type="button" class="btn btn-danger" id="eliminarProducto" value="Eliminar">
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../libraries/animaciones.js"></script>
    <script src="../../controller/funcionesProducto.js"></script>
    <?php include('../footer.php') ?>
    </section>
</body> 
</html>