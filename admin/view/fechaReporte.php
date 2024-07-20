
<?php

    include("../model/conexion.php");
    include("../model/consultas.php");
    $conexion = new conexion();
    $consultas = new consultas($conexion);

    $consultaCaja = $consultas->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    $estadoCaja = $consultaCaja[0]['estado_caja'];
    $usuarioCaja = $consultaCaja[0]['id_usCaja'];

    if ($estadoCaja!="Cerrada" && $usuarioCaja==1){

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/style.css">
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  </head>
  <body>

    <?php 
        include('header.php');
        include('../model/datosCategoria.php');
        
        $misCategoria = new misCategoria();

        $reporte = $_GET['reporte'];
        if ($reporte=="ganancias"){
            $reporte="Ganancias";
        } elseif ($reporte=="ventas"){
            $reporte="Ventas";
        }

        echo "<script>let reporte='".$_GET['reporte']."'</script>";

        $tipo = $_GET['tipo'];

    ?>

    <script>
        function formatos(formato, reporte){
            inputFormato = document.getElementById('inputFormato');
            if (formato=="web"){
                inputFormato.value="web";
                console.log("El formato sera Web...");
            } else if (formato=="pdf"){
                inputFormato.value="pdf";
                console.log("El formato sera PDF...");
            }

            $(document).ready(function() {
                $("#"+reporte).click();
            });
        }
    </script>

    <section class="contenido">
        <?php include('barraHorizontal.php') ?>
        <div class="interfaz overflow-auto">
            <div class="filtros">
                <?php 
                    if ($tipo=="porFecha"){
                        echo '
                        <h4>Reporte por Fechas:</h4>
                        <form action="reporte'.$reporte.'.php?tipo=porFecha" class="filtro d-flex flex-column w-75 gap-3" method="post" enctype="multipart/form-data">
                            <div class="d-flex gap-4 w-100">
                                <div class="w-100">
                                    <label for="fechaInicio" class="form-label">Fecha Inicio: </label>
                                    <input type="date" id="fechaInicio" name="fechaInicio" value="" class="form-control w-100">
                                </div>
                                <div class="w-100">
                                    <label for="fechaFin" class="form-label">Fecha Fin: </label>
                                    <input type="date" id="fechaFin" name="fechaFin" value="" class="form-control w-100">
                                </div>
                                <div class="w-100">
                                    <label for="categoria" class="form-label">Seleccione una Categoria: </label>
                                    <select id="categoria" name="categoria" class="form-select w-100">
                                        <option value="Ninguna">General</option>.';
                                            $respCategoria = $misCategoria->verCategoria();
                                            foreach ($respCategoria as $fila) {
                                                echo '<option value='.$fila['id_cat'].'>'.$fila['nombre_cat'].'</option>';
                                            };
                                    echo '</select>
                                </div>
                            </div>
                            <div class="d-flex gap-4">
                                <input type="text" id="inputFormato" name="formato" class="d-none" value="">

                                <button type="button" onclick="formatos('."'web'".', '."'porFecha'".')" class="btn btn-success w-25 mt-2">Generar Informe</button>
                                <button type="button" onclick="formatos('."'pdf'".', '."'porFecha'".')" class="btn btn-danger w-25 mt-2">Generar PDF</button>

                                <input type="submit" id="porFecha" class="btn btn-danger w-25 mt-2 d-none">
                            </div>

                        </form>';
                    } elseif ($tipo=="porDia"){
                        echo '
                        <h4>Reporte por Dia:</h4>
                        <form action="reporte'.$reporte.'.php?tipo=porDia" class="filtro d-flex flex-column w-50 gap-3" method="post" enctype="multipart/form-data">
                            <div class="d-flex gap-4 w-100">
                                <div class="w-100">
                                    <label for="dia" class="form-label">Seleccione el Dia: </label>
                                    <input type="date" id="dia" name="dia" value="" class="form-control w-100">
                                </div>
                                <div class="w-100">
                                    <label for="categoria" class="form-label">Seleccione una Categoria: </label>
                                    <select id="categoria" name="categoria" class="form-select w-100">
                                        <option value="Ninguna">General</option>.';
                                            $respCategoria = $misCategoria->verCategoria();
                                            foreach ($respCategoria as $fila) {
                                                echo '<option value='.$fila['id_cat'].'>'.$fila['nombre_cat'].'</option>';
                                            };
                                    echo '</select>
                                </div>
                            </div>
                            <div class="d-flex gap-4">
                                <input type="text" id="inputFormato" name="formato" class="d-none" value="">

                                <button type="button" onclick="formatos('."'web'".', '."'porDia'".')" class="btn btn-success w-50 mt-2">Generar Informe</button>
                                <button type="button" onclick="formatos('."'pdf'".', '."'porDia'".')" class="btn btn-danger w-50 mt-2">Generar PDF</button>

                                <input type="submit" id="porDia" class="btn btn-danger w-25 mt-2 d-none">
                            </div>
                        </form>';
                    } elseif ($tipo=="porMes"){
                        echo '
                        <h4>Reporte por Mes:</h4>
                        <form action="reporte'.$reporte.'.php?tipo=porMes" class="filtro d-flex flex-column w-75 gap-3" method="post" enctype="multipart/form-data">
                            <div class="d-flex gap-4 w-100">
                                <div class="w-100">
                                    <label for="mes" class="form-label">Seleccione el Mes: </label>
                                    <select name="mes" id="mes" class="form-select w-100">
                                        <option value="-01">Enero</option>
                                        <option value="-02">Febrero</option>
                                        <option value="-03">Marzo</option>
                                        <option value="-04">Abril</option>
                                        <option value="-05">Mayo</option>
                                        <option value="-06">Junio</option>
                                        <option value="-07">Julio</option>
                                        <option value="-08">Agosto</option>
                                        <option value="-09">Septiembre</option>
                                        <option value="-10">Octubre</option>
                                        <option value="-11">Noviembre</option>
                                        <option value="-12">Diciembre</option>
                                    </select>
                                </div>
                                <div class="w-100">
                                    <label for="anio" class="form-label">Ingrese el Año: (Ej: 2024)</label>
                                    <input type="text" id="anio" name="anio" value="" class="form-control w-100">
                                </div>
                                <div class="w-100">
                                    <label for="categoria" class="form-label">Seleccione una Categoria: </label>
                                    <select id="categoria" name="categoria" class="form-select w-100">
                                        <option value="Ninguna">General</option>.';
                                            $respCategoria = $misCategoria->verCategoria();
                                            foreach ($respCategoria as $fila) {
                                                echo '<option value='.$fila['id_cat'].'>'.$fila['nombre_cat'].'</option>';
                                            };
                                    echo '</select>
                                </div>
                            </div>
                            <div class="d-flex gap-4 w-100">
                                <input type="text" id="inputFormato" name="formato" class="d-none" value="">

                                <button type="button" onclick="formatos('."'web'".', '."'porMes'".')" class="btn btn-success w-25 mt-2">Generar Informe</button>
                                <button type="button" onclick="formatos('."'pdf'".', '."'porMes'".')" class="btn btn-danger w-25 mt-2">Generar PDF</button>

                                <input type="submit" id="porMes" class="btn btn-danger w-25 mt-2 d-none">
                            </div>
                        </form>';
                    }
                ?>
            </div>

    </section>
    <script src="../libraries/animaciones.js"></script>
    <!-- FOOTER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <?php
    
        } else {
            echo '<script>
                    alert("Error al acceder. La cuenta esta inactiva o el usuario activo no tiene un rol de admin, por lo cual no puede acceder a este apartado")
                </script>';
        }

    ?>

  </body>
</html>

