<?php

require_once 'conexion.php';
require_once 'consultas.php';

$conexion = new Conexion();
$consultas = new consultas($conexion);

if (isset($_GET['accion'])) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable

    if ($accion == "registrar") {

        $nombre_us = $_POST['nombre_us'];
        $apellido_us = $_POST['apellido_us'];
        $jornada_us = $_POST['jornada_us'];
        $telefono_us = $_POST['telefono_us'];
        $correo_us = $_POST['correo_us'];
        $estado_us = $_POST['estado_us'];
        $rol_us = $_POST['rol_us'];
        $password = $_POST['password'];

        $sqlReg = "INSERT INTO usuario (id_us,nombre_us, apellido_us, jornada_us, telefono_us, correo_us, estado_us, rol_us,password) VALUES (NULL,?,?,?,?,?,?,?,?)";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_us);
        $reg->bindParam(2, $apellido_us);
        $reg->bindParam(3, $jornada_us);
        $reg->bindParam(4, $telefono_us);
        $reg->bindParam(5, $correo_us);
        $reg->bindParam(6, $estado_us);
        $reg->bindParam(7, $rol_us);
        $reg->bindParam(8, $password);

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "editar") {

        $id_us = $_POST['id_us'];
        $nombre_us = $_POST['nombre_us'];
        $apellido_us = $_POST['apellido_us'];
        $jornada_us = $_POST['jornada_us'];
        $telefono_us = $_POST['telefono_us'];
        $correo_us = $_POST['correo_us'];
        $estado_us = $_POST['estado_us'];
        $rol_us = $_POST['rol_us'];
        $password = $_POST['password'];

        $sqlReg = "UPDATE usuario SET nombre_us = ?,apellido_us = ?, jornada_us = ?, telefono_us = ?, correo_us = ?, estado_us = ?, rol_us = ?, password = ? WHERE id_us = $id_us";
        $reg = $conexion->prepare($sqlReg);

        $reg->bindParam(1, $nombre_us);
        $reg->bindParam(2, $apellido_us);
        $reg->bindParam(3, $jornada_us);
        $reg->bindParam(4, $telefono_us);
        $reg->bindParam(5, $correo_us);
        $reg->bindParam(6, $estado_us);
        $reg->bindParam(7, $rol_us);
        $reg->bindParam(8, $password);
        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    }  elseif($accion == "eliminar") {

        $id_us = $_POST['id_us'];

        $sqlDel = "DELETE FROM usuario WHERE id_us = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_us);

        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "iniciarSesion") {

        $correo_us = $_POST['correo_us'];
        $password = $_POST['password'];

        $sqlefectivoesperado="SELECT total_caja FROM caja WHERE id_caja = (SELECT MAX(id_caja) FROM caja);";
        $efectivoesperado=$conexion->prepare($sqlefectivoesperado);
        $efectivoesperado->execute();
        $totalcaja=$efectivoesperado->fetch(PDO::FETCH_ASSOC);
        $pruebaTotalCaja="";
        foreach ($totalcaja as $caracter) {
            $pruebaTotalCaja=$pruebaTotalCaja.$caracter;
        };

        $inicioCaja="INSERT INTO caja (id_caja,efectivoesperado_caja, fecha_caja,id_usCaja) values(null,$pruebaTotalCaja,now(),(SELECT id_us FROM usuario WHERE correo_us = '$correo_us' and PASSWORD = '$password'));";
        $consultaUsuario = $consultas->consultaMultiple("SELECT * FROM usuario WHERE correo_us='$correo_us' and password='$password';");

        $sqlTipoUsuario="SELECT rol_us FROM usuario WHERE correo_us='$correo_us' and password='$password';";
        $TipoDeUsuario=$conexion->prepare($sqlTipoUsuario);
        $TipoDeUsuario->execute();
        $tipoUsuario=$TipoDeUsuario->fetch(PDO::FETCH_ASSOC);
        $pruebaTipoUsuario="";
        foreach ($tipoUsuario as $caracter) {
            $pruebaTipoUsuario=$pruebaTipoUsuario.$caracter;
        };
        
        if (count($consultaUsuario)==0){
            echo 0;
        } else {
            if($pruebaTipoUsuario=="Admin"){
                $inicioCaja=$conexion->prepare($inicioCaja);
                $inicioCaja->execute();
                echo 1;    
            }else{
                if($pruebaTipoUsuario=="Empleado"){
                $inicioCaja=$conexion->prepare($inicioCaja);
                $inicioCaja->execute();
                echo 2;
                    }
                 }
        }
    }
    else {
        echo 0;
    }
}
?>