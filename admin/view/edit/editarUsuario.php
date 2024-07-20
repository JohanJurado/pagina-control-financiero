<?php
include ("../../model/datosUsuario.php");
$misUsuario = new misUsuarios();

// Validaciones de envio de variable
if(isset($_GET['id_us'])) { // la variable se trae desde el navegador
  $id_us = $_GET['id_us'];
  // Buscamos el curso a modificar o eliminar
  $respUsuario = $misUsuario->verUsuarioId($id_us);
  // Asignamos el resultado de la búsqueda
  if(count($respUsuario) > 0) {
    $id_us = $respUsuario[0]['id_us'];
    $nombre_us = $respUsuario[0]['nombre_us'];
    $apellido_us = $respUsuario[0]['apellido_us'];
    $jornada_us=$respUsuario[0]['jornada_us'];
    $telefono_us=$respUsuario[0]['telefono_us'];
    $correo_us=$respUsuario[0]['correo_us'];
    $estado_us=$respUsuario[0]['estado_us'];
    $rol_us=$respUsuario[0]['rol_us'];
    $password=$respUsuario[0]['password'];

  } else {
    echo '<script>
        alert ("El usuario seleccionada no fue encontrada.")
        self.location="../usuario.php"
        </script>';
  }
    
} else {
  echo '<script>
        alert ("Debe seleccionar un usuario")
        self.location="../usuario.php"
        </script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../libraries/style.css">

    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
  <body>

    <section class="header">
        <div class="nombre">
            <p class="m-0">JORVAN - INVENTORY</p>
        </div>
        <div class="fecha">
            <p><?php date_default_timezone_set('America/Bogota'); echo date("d/m/Y  g:i a");?></p>
            <div class="perfil">
                <p class="m-0">Perfil Admin</p>
                <div class="clicPerfil d-none">
                    <p class="m-0">
                        <i class="bi bi-person-circle"></i>    
                        Perfil
                    </p>
                    <p class="m-0">
                        <i class="bi bi-power"></i>
                        Salir
                    </p>
                </div>
            </div>
        </div>
    </section>
<section class="contenido">
    <?php include('barraHorizontalEdit.php') ?>
    <div class="interfaz overflow-auto d-flex justify-content-center">
        <div class="categorias w-50">
                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>EDITAR USUARIO</h6>
                    </div>
                    <form class="body" enctype="multipart/form-data">
                        <div>
                            <label for="id_us" class="form-label">Id usuario:</label>
                            <input class="form-control" type="text" id="id_us" name="id_us" readonly value="<?php echo $id_us; ?>">
                        </div>
                        <div>
                            <label for="nombre_us" class="form-label">Nombre usuario:</label>
                            <input class="form-control" type="text" id="nombre_us" name="nombre_us" value="<?php echo $nombre_us; ?>">
                        </div>
                        <div>
                            <label for="apellido_us" class="form-label">Apellido usuario:</label>
                            <input class="form-control" type="text" id="apellido_us" name="apellido_us" value="<?php echo $apellido_us;?>">
                        </div>
                        <div>
                            <label for="jornada_us" class="form-label">Jornada usuario:</label>
                            <select name="jornada_us" id="jornada_us" class="form-select">
                                <?php echo '<option value="'.$jornada_us.'" selected>'.$jornada_us.'</option>' ?>
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Completa">Completa</option>
                            </select>
                            <!--<input class="form-control" type="text" id="jornada_us" name="jornada_us" value="<?php echo $jornada_us; ?>">-->
                        </div>
                        <div>
                            <label for="telefono_us" class="form-label">Telefono usuario:</label>
                            <input class="form-control" type="number" id="telefono_us" name="telefono_us" value="<?php echo $telefono_us; ?>">
                        </div>
                        <div>
                            <label for="correo_us" class="form-label">Correo usuario:</label>
                            <input class="form-control" type="text" id="correo_us" name="correo_us" value="<?php echo $correo_us; ?>">
                        <div>
                            <label for="estado_us" class="form-label">Estado usuario:</label>
                            <input class="form-control" type="text" id="estado_us" name="estado_us" value="<?php echo $estado_us; ?>" min="0" max="99999">
                        </div>
                        <div>
                            <label for="rol_us" class="form-label">Rol usuario:</label>
                            <select name="rol_us" id="rol_us" class="form-select">
                                <option value="" disabled selected>Elija el rol del usuario</option>
                                <option value="Admin">Admin</option>
                                <option value="Empleado">Empleado</option>                                
                            </select>
                        </div>
                        <div>
                            <label for="password" class="form-label">Contraseña usuario:</label>
                            <input class="form-control" type="text" id="password" name="password" value="<?php echo $password; ?>">
                        </div>                     
                        <div>
                            <label for="" class="form-label"></label>
                            <div class="d-flex gap-3">
                            <input type="button" class="btn btn2" id="editarUsuario" value="Editar">
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../libraries/animaciones.js"></script>
    <script src="../../controller/funcionesUsuario.js"></script>
    <?php include('../footer.php') ?>
    </section>
</body> 
</html>