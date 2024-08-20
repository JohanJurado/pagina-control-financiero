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
    <?php 
        include('header.php');
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
            <div class="filtros">
                <h4>Filtros:</h4>
                <div class="consultas">
                    <form action="../model/accionesProducto.php?accion=filtrar&atributo=nombreProducto" class="filtro" method="post">
                        <div class="">
                            <label for="nombreProducto" class="form-label">Nombre producto:</label>
                            <input type="text" list="nombreproducto" name="nombreProducto" id="nombreProducto" class="form-control w-75" value="">
                            <datalist id="nombreproducto">
                            <?php
                            $respNombreProducto=$misProducto->verProducto("SELECT * FROM producto");
                            foreach($respNombreProducto as $fila){?>
                            <option value="<?php echo $fila['nombre_prod'] ?>"><?php echo $fila['nombre_prod'] ?></option>
                            <?php } ?>
                            </datalist>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroNombre" value="Filtro Nombre">
                    </form>
                    <form action="../model/accionesProducto.php?accion=filtrar&atributo=stockMinimo"  class="filtro" method="post">
                        <div class="">
                            <label for="stockMinimo" name="stockMinimo" class="form-label">Fitros rapidos:</label>
                        </div>
                        <input type="submit" class="btn btn2 w-75 mt-0" id="stockMinimo" value="Stock Minimo">
                        <a href="../model/accionesProducto.php?accion=filtrar&atributo=importancia" type="submit" class="btn btn-success w-75 mt-2" id="importancia" >Filtro importancia</a>
                    </form>
                    <form action="../model/accionesProducto.php?accion=filtrar&atributo=categoria"  class="filtro" method="post">
                        <div class="">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select name="categoria" id="categoria" class="form-select w-75">
                                <option value="" selected>Ninguno</option>
                                <?php
                                    $respCategoria = $misCategoria->verCategoria();
                                    foreach ($respCategoria as $fila) {?>
                                        <option value=<?php echo $fila['id_cat']; ?>><?php echo $fila['nombre_cat']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn2 w-75" id="filtroCategoria" value="Filtro Categoria">
                    </form>
                    <form action="../model/accionesProducto.php?accion=filtrar&atributo=proveedor"  class="filtro" method="post">
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

            <div class="categorias">
                <div class="tabla f-2">
                    <div class="head align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>LISTA DE PRODUCTOS</h6>
                    </div>
                    <div class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th class="text-center">Costo</th>
                                <th class="text-center">Ganancia</th>
                                <th class="text-center">Mayorista</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Categoria</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center acciones">Acciones</th>
                                <th class="text-center">Importancia</th>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta="SELECT * FROM producto";
                                    if(isset($_GET['consulta'])){
                                        $consulta=$_GET['consulta'];
                                    }
                                    $respProducto = $misProducto->verProducto($consulta);

                                    if(empty($respProducto)){
                                        echo "<tr><td colspan='12' class='fs-5 text-bg-primary text-center'>No hay productos que coincidan</td></tr>";
                                    }

                                    foreach ($respProducto as $fila) { 
                                        $nombreCategoria= $misCategoria->verCategoriaId($fila['id_catProd']);
                                        $nombreProveedor= $misProveedor->verProveedorId($fila['id_provProd']);
                                        ?>
                                        <tr class="table-light">
                                            <td class="text-center"><?php echo $fila['id_prod']; ?></td>
                                            <td><?php echo $fila['nombre_prod'];?></td>
                                            <td><?php echo $fila['descripcion_prod']; ?></td>
                                            <td><?php echo $fila['costo_prod']; ?></td>
                                            <td class="text-center"><p class="campo naranja"><?php echo round($fila['gananciainicial_prod']); ?>%</p></td>
                                            <td class="text-center"><p class="campo azul"><?php echo round($fila['gananciainicialmay_prod']); ?>%</p></td>

                                            <?php 
                                                    if($fila['stock_prod']==0){
                                                        echo '<td class="text-center"><p class="m-0 campo rojo">'.$fila['stock_prod'].'</p></td>';
                                                    } elseif ($fila['stock_prod']<=$fila['stockMin_prod']) {
                                                        echo '<td class="text-center"><p class="m-0 campo amarillo">'.$fila['stock_prod'].'</p></td>';
                                                    } elseif ($fila['stock_prod']>$fila['stockMin_prod']) {
                                                        echo '<td class="text-center"><p class="m-0 campo verde">'.$fila['stock_prod'].'</p></td>';
                                                    } else {
                                                        echo '<td class="text-center"><p class="m-0 campo">'.$fila['stock_prod'].'</p></td>';
                                                    }
                                            ?>
                                            

                                            <td class="text-center"><?php echo $nombreCategoria[0]['nombre_cat']; ?></td>
                                            <td class="text-center"><?php echo $nombreProveedor[0]['nombre_prov']; ?></td>
                                            <td><center><img height="50px" src="<?php echo($fila['imagen']);?>"/></center></td>
                                            <td><center>
                                                <a href="edit/editarProducto.php?id_prod=<?php echo $fila['id_prod'] ?>" class="btn btn-info" >
                                                    <i class="bi bi-subtract"></i>
                                                    <p class="m-0">Editar</p>
                                                </a>
                                                </center>
                                            </td>
                                            <td><center><a href="../model/accionesProducto.php?accion=importancia&id_prod=<?php echo $fila['id_prod'];?>" type="button" class="btn btn-success">Añadir</a></center>
                                            </td>
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
        <script src="../controller/funcionesProducto.js"></script>
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

