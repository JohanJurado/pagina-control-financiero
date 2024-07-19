<?php
class misUsuarios
{
    // funcion para consultar todos los usuarios
    function verUsuario()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array(); // arreglo vacio para almacenar los datos que va a enviar a la base de datos

        $consulta = "SELECT * FROM usuario";

        $modulos = $conexion->prepare($consulta);
        $modulos->execute();

        $total = $modulos->rowCount(); // cantidad de datos encontrados
        if ($total > 0) {
            $a = 0;
            while ($data = $modulos->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$a] = $data;
                $a++;
            }
        }
        return $arreglo;
    }
    // Función para buscar cursos por id
    function verUsuarioId($id)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT id_us, nombre_us, apellido_us, jornada_us, telefono_us, correo_us, estado_us, rol_us,password FROM usuario
                    WHERE id_us = :id";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":id", $id);
        $modules->execute();
        $total = $modules->rowCount(); // 1 - Cantidad de resultados encontrados
        if ($total > 0) {
            $i = 0;
            while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$i] = $data;
                $i++;
            }
        }
        return $arreglo;
    }

    function addUsuario($id_us)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT id_us, nombre_us, apellido_us, jornada_us, telefono_us, correo_us, estado_us, rol_us,password FROM usuario
                    WHERE id_us = :id_us";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":id_us", $id_us);
        $modules->execute();
        $total = $modules->rowCount(); // 1 - Cantidad de resultados encontrados
        if ($total > 0) {
            $i = 0;
            while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$i] = $data;
                $i++;
            }
        }
        return $arreglo;
    }


}
?>