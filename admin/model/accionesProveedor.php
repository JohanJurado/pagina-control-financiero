<?php

require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        $nombre_prov = $_POST['nombre_prov'];

        $sqlReg = "INSERT INTO proveedor (id_prov, nombre_prov) VALUES (NULL, ?)";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_prov);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "editar") {

        $id_prov =  $_POST['id_prov'];
        $nombre_prov = $_POST['nombre_prov'];

        $sqlReg = "UPDATE proveedor SET nombre_prov = ? WHERE id_prov = $id_prov";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_prov);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "eliminar") {

        $id_prov = $_POST['id_prov'];

        $sqlDel = "DELETE FROM proveedor WHERE id_prov = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_prov);

        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    }
    else {
        echo 0;
    }
}
?>