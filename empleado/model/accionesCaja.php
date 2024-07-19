<?php

require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "abrirCaja") {

        $sqleIdCaja="SELECT id_caja FROM caja WHERE id_caja = (SELECT MAX(id_caja) FROM caja);";
        $id_caja=$conexion->prepare($sqleIdCaja);
        $id_caja->execute();
        $IDcaja=$id_caja->fetch(PDO::FETCH_ASSOC);
        $pruebaTotalCaja="";
        foreach ($IDcaja as $caracter) {
            $pruebaTotalCaja=$pruebaTotalCaja.$caracter;
        };

        $monedas_caja = $_POST['total_monedas'];
        $billetes_caja = $_POST['total_billetes'];
        $total_caja = $_POST['total_total'];
        $estado_caja="Activa";

        $sqlReg = "UPDATE caja SET monedas_caja = '$monedas_caja', billetes_caja = '$billetes_caja', total_caja = '$total_caja', fecha_caja = now(), estado_caja='$estado_caja' WHERE id_caja = '$pruebaTotalCaja'";
        $reg = $conexion->prepare($sqlReg);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "cerrarCaja"){
        $sqleIdCaja="SELECT id_caja FROM caja WHERE id_caja = (SELECT MAX(id_caja) FROM caja);";
        $id_caja=$conexion->prepare($sqleIdCaja);
        $id_caja->execute();
        $IDcaja=$id_caja->fetch(PDO::FETCH_ASSOC);
        $pruebaTotalCaja="";
        foreach ($IDcaja as $caracter) {
            $pruebaTotalCaja=$pruebaTotalCaja.$caracter;
        };

        $monedas_caja = $_POST['total_monedas'];
        $billetes_caja = $_POST['total_billetes'];
        $total_caja = $_POST['total_total'];
        $estado_caja="Cerrada";

        $sqlReg = "UPDATE caja SET monedas_caja = '$monedas_caja', billetes_caja = '$billetes_caja', total_caja = '$total_caja', fecha_caja = now(), estado_caja='$estado_caja' WHERE id_caja = '$pruebaTotalCaja'";
        $reg = $conexion->prepare($sqlReg);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "descripcionReporte"){
        $sqleIdCaja="SELECT id_caja FROM caja WHERE id_caja = (SELECT MAX(id_caja) FROM caja);";
        $id_caja=$conexion->prepare($sqleIdCaja);
        $id_caja->execute();
        $IDcaja=$id_caja->fetch(PDO::FETCH_ASSOC);
        $pruebaTotalCaja="";
        foreach ($IDcaja as $caracter) {
            $pruebaTotalCaja=$pruebaTotalCaja.$caracter;
        };

        $descreporte_caja = $_POST['descreporte_caja'];

        $sqlReg = "UPDATE caja SET descreporte_caja = '$descreporte_caja'WHERE id_caja = '$pruebaTotalCaja'";
        $reg = $conexion->prepare($sqlReg);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "filtrar") {

        if ($_GET['atributo']=="usuario"){
            $valor =  $_POST['usuario'];
            $consulta="SELECT * FROM caja WHERE id_usCaja=$valor";
        } elseif($_GET['atributo']=="reportes"){
            $consulta="SELECT * FROM caja WHERE descreporte_caja IS NOT NULL";
        } elseif($valor==""){
            $consulta="SELECT * FROM caja";
            //$consulta="SELECT * FROM caja WHERE id_usCaja=1";
        }

        echo $consulta;
        header('Location: ../view/historialCaja.php?consulta='.$consulta);

    }
    else {
        echo 0;
    }
}
?>