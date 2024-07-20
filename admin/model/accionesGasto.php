<?php

require_once 'conexion.php';
$conexion = new Conexion();

include("./consultas.php");
$consultas=new consultas($conexion);

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        $nombre_gasto = $_POST['nombre_gasto'];
        $desc_gasto = $_POST['desc_gasto'];
        $metodopago_gasto = $_POST['metodopago_gasto'];
        $total_gasto = $_POST['total_gasto'];
        $tipo_gasto = $_POST['tipo_gasto'];
        $id_cajaGasto = $_POST['id_cajaGasto'];
        $id_facturaGasto = $_POST['id_facturaGasto'];
        $fecha_gasto = $_POST['fecha_gasto'];


        $sqlReg = "INSERT INTO gasto (id_gasto, nombre_gasto, desc_gasto, metodopago_gasto, total_gasto, tipo_gasto, id_cajaGasto, id_facturaGasto,fecha_gasto) VALUES (NULL,?,?,?,?,?,?,?,?)";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_gasto);
        $reg->bindParam(2, $desc_gasto);
        $reg->bindParam(3, $metodopago_gasto);
        $reg->bindParam(4, $total_gasto);
        $reg->bindParam(5, $tipo_gasto);
        $reg->bindParam(6, $id_cajaGasto);
        $reg->bindParam(7, $id_facturaGasto);
        $reg->bindParam(8, $fecha_gasto);

        if ($tipo_gasto=="Otro"){
            if ($reg->execute()) {
                $rta=1;
            } else {
                $rta=0;
            }
        } else {
            $consulta_abono="SELECT abono_fac, total_fac FROM factura WHERE id_fac=$id_facturaGasto";
            $abono = $consultas->consultaMultiple($consulta_abono);

            $suma_abonos=$abono[0]['abono_fac']+$total_gasto;
            
            if ($suma_abonos<$abono[0]['total_fac']){
                $actualizar_abono="UPDATE factura SET abono_fac = $suma_abonos WHERE id_fac=$id_facturaGasto";

                $update = $conexion->prepare($actualizar_abono);
                $reg->execute();
                $update->execute();
                $rta=2;
            } elseif($suma_abonos==$abono[0]['total_fac']){
                $actualizar_abono="UPDATE factura SET abono_fac = $suma_abonos, estado_fac = 'Pagado' WHERE id_fac=$id_facturaGasto";

                $update = $conexion->prepare($actualizar_abono);
                $reg->execute();
                $update->execute();
                $rta=2;
            } else {
                $rta=3;
            }            
        }

        if ($metodopago_gasto=="Efectivo" && $rta!=3 && $rta!=0){
            $efectivoesperadoConsulta = $consultas->consultaMultiple("SELECT efectivoesperado_caja as efectivo FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
            $efectivoesperadoActualizado = $efectivoesperadoConsulta[0]['efectivo']-$total_gasto;

            $sqlReg = "UPDATE caja SET efectivoesperado_caja=$efectivoesperadoActualizado WHERE id_caja=(SELECT max(id_caja) FROM caja)";
            $reg = $conexion->prepare($sqlReg);
            $reg->execute();
            echo $rta;
        } else {
            echo $rta;
        }
        
    } elseif ($accion == "editar") {

        $id_gasto = $_POST['id_gasto'];
        $nombre_gasto = $_POST['nombre_gasto'];
        $desc_gasto = $_POST['desc_gasto'];
        $metodopago_gasto = $_POST['metodopago_gasto'];
        $total_gasto = $_POST['total_gasto'];
        $tipo_gasto = $_POST['tipo_gasto'];
        $id_cajaGasto = $_POST['id_cajaGasto'];
        $id_facturaGasto = $_POST['id_facturaGasto'];
        $fecha_gasto = $_POST['fecha_gasto'];

        $sqlReg = "UPDATE gasto SET nombre_gasto = ?,desc_gasto=?,metodopago_gasto=?,total_gasto=?,tipo_gasto=?,id_cajaGasto=?,id_facturaGasto=?,fecha_gasto=? WHERE id_gasto = $id_gasto";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_gasto);
        $reg->bindParam(2, $desc_gasto);
        $reg->bindParam(3, $metodopago_gasto);
        $reg->bindParam(4, $total_gasto);
        $reg->bindParam(5, $tipo_gasto);
        $reg->bindParam(6, $id_cajaGasto);
        $reg->bindParam(7, $id_facturaGasto);
        $reg->bindParam(8, $fecha_gasto);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "eliminar") {

        $id_gasto = $_POST['id_gasto'];

        $sqlDel = "DELETE FROM gasto WHERE id_gasto = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_gasto);

        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "filtrar") {

        if ($_GET['atributo']=="fecha"){
            $valor="fecha";
            $fechaInicio =  $_POST['fechaInicio'];
            $fechaFin =  $_POST['fechaFin'];
            if ($fechaInicio=="" && $fechaFin==""){
                $valor="";
            } else if ($fechaInicio==""){
                $fechaInicio=$fechaFin;
            } else if ($fechaFin=="") {
                $fechaFin=$fechaInicio;
            }
            $consulta="SELECT * FROM gasto WHERE fecha_gasto BETWEEN '$fechaInicio' AND '$fechaFin' ORDER BY id_gasto DESC";
        } elseif ($_GET['atributo']=="nombre"){
            $valor =  $_POST['nombre'];
            $consulta="SELECT * FROM gasto WHERE nombre_gasto like '$valor%' ORDER BY id_gasto DESC";
        } elseif($_GET['atributo']=="tipo"){
            $valor =  $_POST['tipo'];
            $consulta="SELECT * FROM gasto WHERE tipo_gasto='$valor' ORDER BY id_gasto DESC";
        }

        if($valor==""){
            header('Location: ../view/gastos.php');
        } else {
            echo $consulta;
            header('Location: ../view/gastos.php?consulta='.$consulta);
        }

    } else {
        echo 0;
    }
}
?>