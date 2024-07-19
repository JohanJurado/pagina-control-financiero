<?php
class misProveedor
{
    // funcion para consultar todos los usuarios
    function verProveedor()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array(); // arreglo vacio para almacenar los datos que va a enviar a la base de datos

        $consulta = "SELECT * FROM proveedor";

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
    function verProveedorId($id)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT * FROM proveedor
                    WHERE id_prov = :id";

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

    function addProveedor($id_proveedor)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT * FROM proveedor
                    WHERE id_proveedor = :id_proveedor";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":id_proveedor", $id_proveedor);
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