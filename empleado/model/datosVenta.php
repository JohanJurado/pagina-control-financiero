<?php
class misventa
{
    // funcion para consultar todos los usuarios
    function verVenta($consulta)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array(); // arreglo vacio para almacenar los datos que va a enviar a la base de datos

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
    function verVentaId($id)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT * FROM venta
                    WHERE id_venta = :id";

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

    function addVenta($id_venta)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT * FROM venta
                    WHERE id_venta = :id_venta";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":id_venta", $id_venta);
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