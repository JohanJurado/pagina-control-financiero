<?php

require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        if ($_POST['cantidad_VP']!=null && $_POST['precioVenta_VP']!=null){
            $id_venVP = $_POST['id_venVP'];
            $id_prodVP = $_POST['id_prodVP'];
            $costo_prod = $_POST['costo_prod'];
    
            $cantidad_VP = $_POST['cantidad_VP'];
            $precioVenta_VP = $_POST['precioVenta_VP'];
            $valorganancia_VP = $precioVenta_VP-$costo_prod;
    
            $ganancia_VP = round(($valorganancia_VP/($valorganancia_VP+$costo_prod))*100);
            $total_VP = $cantidad_VP*$precioVenta_VP;
    
            $stock_prod = $_POST['stock_prod'];

            if ($cantidad_VP>$stock_prod){
                echo "no";
                header('Location: ../view/addVentas.php?stock=No');
            } else {
    
                $sqlReg = "INSERT INTO ventaprod (id_VP, ganancia_VP, valorganancia_VP, precioVenta_VP, id_venVP, id_prodVP, cantidad_VP, total_VP) VALUES (NULL,?,?,?,?,?,?,?)";
                $reg = $conexion->prepare($sqlReg);
        
                $reg->bindParam(1, $ganancia_VP);
                $reg->bindParam(2, $valorganancia_VP);
                $reg->bindParam(3, $precioVenta_VP);
                $reg->bindParam(4, $id_venVP);
                $reg->bindParam(5, $id_prodVP);
                $reg->bindParam(6, $cantidad_VP);
                $reg->bindParam(7, $total_VP);
        
                $reg->execute();

                header('Location: ../view/addVentas.php');

            }
    
        } else {
            header('Location: ../view/addVentas.php?campo=vacio');
        }


    } elseif($accion == "eliminar") {

        $id_VP = $_GET['id_VP'];

        $sqlDel = "DELETE FROM ventaprod WHERE id_VP = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_VP);

        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }

        header('Location: ../view/addVentas.php');

    }
    else {
        echo 0;
    }
}
?>