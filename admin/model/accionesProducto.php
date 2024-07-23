<?php
include_once 'conexion.php';
$conexion = new Conexion();

if ((isset($_GET['accion']))) { //valida si está la variable
    $accion = $_GET['accion']; //obtiene el valor de la variable
    $data = json_decode(file_get_contents('php://input'), true);

    if ($accion == "registrar") {
//AQUI EMPIEZA LA FUNCION REGISTRAR /*
        $nombre_prod = $data['nombre_prod'];
        $descripcion_prod = $data['descripcion_prod'];
        $costo_prod = $data['costo_prod'];        
        $valorganancia_prod = $data['valorganancia_prod'];
        $valorgananciamay_prod = $data['valorgananciamay_prod'];
        $stock_prod = $data['stock_prod'];
        $stockMin_prod = $data['stockMin_prod'];
        $importancia_prod = "No";
        $id_catProd = $data['id_catProd'];
        $id_provProd = $data['id_provProd'];
        $imagenData  = $data['imagen'];
        $nombreArchivo = $data['nombreArchivo'];

        $gananciainicial_prod = ($valorganancia_prod/($valorganancia_prod+$costo_prod))*100;
        $gananciainicialmay_prod = ($valorgananciamay_prod/($valorgananciamay_prod+$costo_prod))*100;

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        // Convertir la imagen de Base64 a datos binarios
        $imagenData = base64_decode($imagenData);

        // Validar la extensión del archivo
        if (strtolower($extension) !== 'jpg' && strtolower($extension) !== 'jpeg' && strtolower($extension) !== 'png') {
            echo 'El archivo debe ser una imagen con extension JPG o JPEG o PNG';
            exit;
        }

        $newFileName = md5(time() . $nombreArchivo) . '.' . $extension;

        $carpeta="../../img/";

       // $uploadFile = $carpeta . basename($nombreArchivo);
        $uploadFile = $carpeta . basename($newFileName);

        $imagen = "../../img/".basename($newFileName);

        if (file_put_contents($uploadFile, $imagenData)) {
            // Aquí puedes insertar los datos en la base de datos o realizar otras acciones
            echo 'Datos y archivo subidos exitosamente';
        } else {
            echo 'Error al subir el archivo';
        }

        $sqlReg="INSERT INTO producto(`id_prod`, `nombre_prod`, `descripcion_prod`, `costo_prod`, `gananciainicial_prod`, `gananciainicialmay_prod`, `valorganancia_prod`, `valorgananciamay_prod`, `stock_prod`, `stockMin_prod`, `importancia_prod`, `id_catProd`, `id_provProd`, `imagen`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $reg = $conexion->prepare($sqlReg);
    
        $reg->bindParam(1,$nombre_prod);
        $reg->bindParam(2,$descripcion_prod);
        $reg->bindParam(3,$costo_prod);
        $reg->bindParam(4,$gananciainicial_prod);
        $reg->bindParam(5,$gananciainicialmay_prod);
        $reg->bindParam(6,$valorganancia_prod);
        $reg->bindParam(7,$valorgananciamay_prod);
        $reg->bindParam(8,$stock_prod);
        $reg->bindParam(9,$stockMin_prod);
        $reg->bindParam(10,$importancia_prod);
        $reg->bindParam(11,$id_catProd);
        $reg->bindParam(12,$id_provProd);
        $reg->bindParam(13,$imagen);



        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "editar") {

        if (isset($data['imagen'])){
            $id_prod = $data['id_prod'];
            $nombre_prod = $data['nombre_prod'];
            $descripcion_prod = $data['descripcion_prod'];
            $costo_prod = $data['costo_prod'];
            $valorganancia_prod = $data['valorganancia_prod'];
            $valorgananciamay_prod = $data['valorgananciamay_prod'];
            $stock_prod = $data['stock_prod'];
            $stockMin_prod = $data['stockMin_prod'];
            $importancia_prod = "No";
            $id_catProd = $data['id_catProd'];
            $id_provProd = $data['id_provProd'];


            $imagenData  = $data['imagen'];
            $nombreArchivo = $data['nombreArchivo'];

            $gananciainicial_prod = ($valorganancia_prod/($valorganancia_prod+$costo_prod))*100;
            $gananciainicialmay_prod = ($valorgananciamay_prod/($valorgananciamay_prod+$costo_prod))*100;

            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

            // Convertir la imagen de Base64 a datos binarios
            $imagenData = base64_decode($imagenData);

            // Validar la extensión del archivo
            if (strtolower($extension) !== 'jpg' && strtolower($extension) !== 'jpeg' && strtolower($extension) !== 'png') {
                echo 'El archivo debe ser una imagen con extension JPG o JPEG o PNG';
                exit;
            }

            $newFileName = md5(time() . $nombreArchivo) . '.' . $extension;

            $carpeta="../view/img/";

            // $uploadFile = $carpeta . basename($nombreArchivo);
            $uploadFile = $carpeta . basename($newFileName);

            $imagen = "img/".basename($newFileName);

            if (file_put_contents($uploadFile, $imagenData)) {
                // Aquí puedes insertar los datos en la base de datos o realizar otras acciones
                echo 'Datos y archivo subidos exitosamente';
            } else {
                echo 'Error al subir el archivo';
            }

            $sqlReg = "UPDATE producto SET nombre_prod = ?,descripcion_prod = ?, costo_prod = ?,gananciainicial_prod = ?, gananciainicialmay_prod = ?, valorganancia_prod = ?, valorgananciamay_prod = ?, stock_prod = ?, stockMin_prod = ?, importancia_prod = ?, id_catProd = ?, id_provProd = ?, imagen = ? WHERE id_prod = $id_prod";

            $reg = $conexion->prepare($sqlReg);
    
            $reg->bindParam(1,$nombre_prod);
            $reg->bindParam(2,$descripcion_prod);
            $reg->bindParam(3,$costo_prod);
            $reg->bindParam(4,$gananciainicial_prod);
            $reg->bindParam(5,$gananciainicialmay_prod);
            $reg->bindParam(6,$valorganancia_prod);
            $reg->bindParam(7,$valorgananciamay_prod);
            $reg->bindParam(8,$stock_prod);
            $reg->bindParam(9,$stockMin_prod);
            $reg->bindParam(10,$importancia_prod);
            $reg->bindParam(11,$id_catProd);
            $reg->bindParam(12,$id_provProd);
            $reg->bindParam(13,$imagen);

        } else {

            $id_prod = $_POST['id_prod'];
            $nombre_prod = $_POST['nombre_prod'];
            $descripcion_prod = $_POST['descripcion_prod'];
            $costo_prod = $_POST['costo_prod'];
            $valorganancia_prod = $_POST['valorganancia_prod'];
            $valorgananciamay_prod = $_POST['valorgananciamay_prod'];
            $stock_prod = $_POST['stock_prod'];
            $stockMin_prod = $_POST['stockMin_prod'];
            $importancia_prod = "No";
            $id_catProd = $_POST['id_catProd'];
            $id_provProd = $_POST['id_provProd'];

            $gananciainicial_prod = ($valorganancia_prod/($valorganancia_prod+$costo_prod))*100;
            $gananciainicialmay_prod = ($valorgananciamay_prod/($valorgananciamay_prod+$costo_prod))*100;
            
            $sqlReg = "UPDATE producto SET nombre_prod = ?,descripcion_prod = ?, costo_prod = ?,gananciainicial_prod = ?, gananciainicialmay_prod = ?, valorganancia_prod = ?, valorgananciamay_prod = ?, stock_prod = ?, stockMin_prod = ?, importancia_prod = ?, id_catProd = ?, id_provProd = ? WHERE id_prod = $id_prod";

            $reg = $conexion->prepare($sqlReg);
    
            $reg->bindParam(1,$nombre_prod);
            $reg->bindParam(2,$descripcion_prod);
            $reg->bindParam(3,$costo_prod);
            $reg->bindParam(4,$gananciainicial_prod);
            $reg->bindParam(5,$gananciainicialmay_prod);
            $reg->bindParam(6,$valorganancia_prod);
            $reg->bindParam(7,$valorgananciamay_prod);
            $reg->bindParam(8,$stock_prod);
            $reg->bindParam(9,$stockMin_prod);
            $reg->bindParam(10,$importancia_prod);
            $reg->bindParam(11,$id_catProd);
            $reg->bindParam(12,$id_provProd);
        }

        if ($reg->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif($accion == "eliminar") {

        $id_prod = $_POST['id_prod'];

        $sqlDel = "DELETE FROM producto WHERE id_prod = ?";

        $del = $conexion->prepare($sqlDel);
        $del->bindParam(1, $id_prod);

        // Verificamos que se ejecutó la consulta
        if($del->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($accion == "filtrar") {

        if ($_GET['atributo']=="nombreProducto"){
            $valor = $_POST['nombreProducto'];
            $consulta="SELECT * FROM producto WHERE nombre_prod='$valor'";
        } elseif ($_GET['atributo']=="stockMinimo"){
            $valor = 'stockMin_prod';
            $consulta="SELECT * FROM producto WHERE stock_prod<=$valor";
        } elseif($_GET['atributo']=="proveedor"){
            $valor =  $_POST['proveedor'];
            $consulta="SELECT * FROM producto WHERE id_provProd=$valor";
        } elseif($_GET['atributo']=="categoria"){
            $valor =  $_POST['categoria'];
            $consulta="SELECT * FROM producto WHERE id_catProd=$valor";
        }elseif($_GET['atributo']=="importancia"){
            $valor = "Si";
            $consulta="SELECT * FROM producto WHERE importancia_prod='$valor'";
        }

        if($valor==""){
            header('Location: ../view/producto.php');
        } else {
            echo $consulta;
            header('Location: ../view/producto.php?consulta='.$consulta);
        }

    } elseif($accion == "importancia"){

        $id_prod=$_GET['id_prod'];

        $sqlAct="UPDATE`producto` SET`importancia_prod` = 'Si' WHERE `id_prod` = ?";
        $act =$conexion->prepare($sqlAct);
        $act->bindParam(1,$id_prod);
        $act->execute();           
        header('Location: ../view/producto.php');

    }
    else {
        echo 0;
    }
}
?>