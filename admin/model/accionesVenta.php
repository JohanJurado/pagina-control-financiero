<?php
// se enlaza la conexion a la base de datos
require_once 'conexion.php';
$conexion = new Conexion();

// condicional para saber si existe la variable 'accion' de tipo GET
if (isset($_GET['accion'])) { 
    $accion = $_GET['accion']; 

    // bloque para registrar una venta
    if ($accion == "registrar") {

        // enlazan los archivos necesarios
        include("./datosVentaprod.php");
        include("./datosProducto.php");
        include("./consultas.php");

        // creacion de objetos
        $misProducto = new misProducto();
        $misVentaprod = new misVentaprod();
        $consultas = new consultas($conexion);

        // almacena los productos (id) de la ultima venta
        $respProductosVendidos = $misVentaprod->verVentaprod("SELECT * FROM ventaprod WHERE id_venVP=(SELECT max(id_ven) FROM venta)");

        $cont=0;
        foreach ($respProductosVendidos as $fila){
            // rastrea la cantidad de productos
            $cont+=1;

            // aterrizo el producto
            $producto = $misProducto->verProductoId($fila['id_prodVP']);
            // aterrizo el stock del producto
            $stockProd = $producto[0]['stock_prod'];

            // se realiza la resta entre el stock del producto y la cantidad vendida
            $nuevoStock = $stockProd-$fila['cantidad_VP'];

            // se actualiza en la BD el nuevo valor del stock
            $sqlReg = "UPDATE producto SET stock_prod=? WHERE id_prod=".$producto[0]['id_prod'];
            $reg = $conexion->prepare($sqlReg);
    
            $reg->bindParam(1, $nuevoStock);
            // se ejecutan los comandos
            $reg->execute();
        }

        // retorna 2 al JS si no existen productos en la venta
        if ($cont==0){
            echo 2;
        } else {
            // si existen productos se aterriza la cadena de JS
            $metodopago_ven = $_POST['metodopago_ven'];
            $valortotal_ven = $_POST['valortotal_ven'];
            $id_cajaVenta = $_POST['id_cajaVenta'];

            // se actualiza la venta
            $sqlReg = "UPDATE venta SET fecha_ven=now(), metodopago_ven=?, valortotal_ven=?, id_cajaVenta=? WHERE id_ven=(SELECT max(id_ven) FROM venta)";
            $reg = $conexion->prepare($sqlReg);

            $reg->bindParam(1, $metodopago_ven);
            $reg->bindParam(2, $valortotal_ven);
            $reg->bindParam(3, $id_cajaVenta);
            $reg->execute();

            // si el metodo de pago es efectivo se acumula el valor total en el efectivo esperado de la caja
            if ($metodopago_ven=="Efectivo"){
                $efectivoesperadoConsulta = $consultas->consultaMultiple("SELECT efectivoesperado_caja as efectivo FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
                $efectivoesperadoActualizado = $efectivoesperadoConsulta[0]['efectivo']+$valortotal_ven;
    
                $sqlReg = "UPDATE caja SET efectivoesperado_caja=$efectivoesperadoActualizado WHERE id_caja=(SELECT max(id_caja) FROM caja)";
                $reg = $conexion->prepare($sqlReg);
                $reg->execute();
            }

            // al actualizarse la venta, se crea una nueva venta vacia para recibir los datos de la proxima venta
            $sqlReg = "INSERT INTO venta (id_ven, fecha_ven, metodopago_ven, valortotal_ven, id_cajaVenta) VALUES (NULL, '', '', 0, ?)";
            $reg = $conexion->prepare($sqlReg);

            $reg->bindParam(1, $id_cajaVenta);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        }

    // bloque para eliminar una venta
    } elseif($accion == "eliminar"){
    
        // recibe la id de la venta que se quiere eliminar
        $id_ven=$_POST['id_ven'];

        // se eliminan todos los productos que pertenecen a la ultima venta (tabla ventaprod)
        $sqlReg = "DELETE FROM ventaprod WHERE id_venVP=?";
            $reg = $conexion->prepare($sqlReg);

            $reg->bindParam(1, $id_ven);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }

    // bloque para filtrar los productos del modal (facilita el proceso de añadir un producto a la venta)
    } elseif($accion == "busqueda") {
        
        // condicionales para saber cual campo se digito y cual se dejo vacio
        // los 'echo $busqueda' se usan para retornar la consulta en el JS y asi usarlos en la url
        if($_POST['nombreProducto']=="Ninguno" && $_POST['categoria']=="Ninguno"){
            // busqueda sin datos, se eliminaran los filtros realizados con anterioridad
            $busqueda="SELECT * FROM producto";
            echo $busqueda;
        } elseif ($_POST['nombreProducto']!="Ninguno" && $_POST['categoria']=="Ninguno"){
            // filtro con el nombre del producto
            $nombre_producto = $_POST['nombreProducto'];
            $busqueda="SELECT * FROM producto WHERE nombre_prod='$nombre_producto'";
            echo $busqueda;
        } elseif ($_POST['nombreProducto']=="Ninguno" && $_POST['categoria']!="Ninguno"){
            // filtro con la categoria del producto
            $categoria = $_POST['categoria'];
            $busqueda="SELECT * FROM producto WHERE id_catProd=$categoria";
            echo $busqueda;
        } else {
            // filtro con el nombre y la categoria
            $nombre_producto = $_POST['nombreProducto'];
            $categoria = $_POST['categoria'];

            $busqueda="SELECT * FROM producto WHERE id_catProd=$categoria and nombre_prod='$nombre_producto'";
            echo $busqueda;
        }
    // bloque para filtrar los productos de la lista de ventas (facilita el proceso de encontrar una venta)
    } elseif($accion == "filtrar") {

        include('../model/consultas.php');
        $consultas = new consultas($conexion);

        // condiciones para saber cual filtro fue ejecutado
        // la consulta se guarda y luego se usa en el header (url)
        if ($_GET['atributo']=="fecha"){
            //consulta de fecha de la venta
            $valor = $_POST['fecha'];
            $fecha_original=$valor;
            $consulta="SELECT * FROM venta WHERE fecha_ven LIKE '$fecha_original%' ORDER BY id_ven DESC";
            
        } elseif ($_GET['atributo']=="id"){
            //consulta por id de la venta
            $valor =  $_POST['id'];
            $consulta="SELECT * FROM venta WHERE id_ven=$valor ORDER BY id_ven DESC";
        } elseif($_GET['atributo']=="metodo_pago"){
            //consulta por el metodo de pago de la venta
            $valor =  $_POST['metodo_pago'];
            $consulta="SELECT * FROM venta WHERE metodopago_ven='$valor' ORDER BY id_ven DESC";
        } elseif($_GET['atributo']=="nombreUsuario"){
            //consulta por el encargado de la venta (empleado o admin que realizo la venta)
            $valor =  $_POST['nombreUsuario'];

            $consulta="SELECT v.id_ven, v.fecha_ven, v.metodopago_ven, v.valortotal_ven, v.id_cajaVenta FROM usuario as us, caja as c, venta as v WHERE us.id_us=c.id_usCaja and v.id_cajaVenta=c.id_caja and us.nombre_us = '$valor' ORDER BY id_ven DESC;";
        }
        // redireccion a la web con la consulta en su url
        if($valor==""){
            // direccion vacia por si no se recibio ningun filtro
            header('Location: ../view/ventas.php');

        } else {
            // direccion con consulta para realizar el filtro
            header('Location: ../view/ventas.php?consulta='.$consulta);
        } 


    // retorna 0 cuando se entra en el archivo pero no realiza ninguna accion
    } else {
        echo 0;
    }
}
?>