<?php

require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        $fecha_fac = $_POST['fecha_fac'];
        $total_fac = $_POST['total_fac'];
        $estado_fac = $_POST['estado_fac'];
        $abono_fac = $_POST['abono_fac'];
        $id_provFac = $_POST['id_provFac'];
        $sqlReg = "INSERT INTO factura (id_fac, fecha_fac,total_fac,estado_fac,abono_fac,id_provFac) VALUES (NULL,?,?,?,?,?)";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $fecha_fac);
        $reg->bindParam(2, $total_fac);
        $reg->bindParam(3, $estado_fac);
        $reg->bindParam(4, $abono_fac);
        $reg->bindParam(5, $id_provFac);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "editar") {
        $id_fac =  $_POST['id_fac'];
        $fecha_fac = $_POST['fecha_fac'];
        $total_fac = $_POST['total_fac'];
        $estado_fac = $_POST['estado_fac'];
        $abono_fac = $_POST['abono_fac'];
        $id_provFac = $_POST['id_provFac'];

        $sqlReg = "UPDATE factura SET fecha_fac = ?,total_fac = ?, estado_fac = ?, abono_fac = ?, id_provfac = ? WHERE id_fac = ?";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $fecha_fac);
        $reg->bindParam(2, $total_fac);
        $reg->bindParam(3, $estado_fac);
        $reg->bindParam(4, $abono_fac);
        $reg->bindParam(5, $id_provFac);
        $reg->bindParam(6, $id_fac);
        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "eliminar") {

        $id_fac = $_POST['id_fac'];

        $sqlDel = "DELETE FROM factura WHERE id_fac = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_fac);
        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    }  elseif($accion == "filtrar") {

        if ($_GET['atributo']=="fecha"){
            $valor =  $_POST['fecha'];
            $consulta="SELECT * FROM factura WHERE fecha_fac='$valor'";
        } elseif ($_GET['atributo']=="id"){
            $valor =  $_POST['id'];
            $consulta="SELECT * FROM factura WHERE id_fac=$valor";
        } elseif($_GET['atributo']=="proveedor"){
            $valor =  $_POST['proveedor'];
            $consulta="SELECT * FROM factura WHERE id_provFac=$valor";
        } elseif($_GET['atributo']=="estado"){
            $valor =  $_POST['estado'];
            $consulta="SELECT * FROM factura WHERE estado_fac='$valor'";
        }

        if($valor==""){
            $consulta="SELECT * FROM factura";
        }

        echo $consulta;
        header('Location: ../view/facturas.php?consulta='.$consulta);

    }
    else {
        echo 0;
    }
}
?>