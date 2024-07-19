<?php

require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        $nombre_cat = $_POST['nombre_cat'];

        $sqlReg = "INSERT INTO categoria (id_cat, nombre_cat) VALUES (NULL, ?)";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_cat);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "editar") {

        $id_cat =  $_POST['id_cat'];
        $nombre_cat = $_POST['nombre_cat'];

        $sqlReg = "UPDATE categoria SET nombre_cat = ? WHERE id_cat = $id_cat";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_cat);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "eliminar") {

        $id_cat = $_POST['id_cat'];

        $sqlDel = "DELETE FROM categoria WHERE id_cat = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_cat);

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