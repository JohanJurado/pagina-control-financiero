<?php 
    include("../model/conexion.php");
    include("../model/consultas.php");
    $conexion = new conexion();
    $consultas = new consultas($conexion);

    $consultaCaja = $consultas->consultaMultiple("SELECT * FROM caja WHERE id_caja=(SELECT max(id_caja) FROM caja)");
    $estadoCaja = $consultaCaja[0]['estado_caja'];

    if ($estadoCaja!="Cerrada"){
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorvan Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../libraries/style.css">
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
        </div>
    </section>
    <section class="contenido">
        <div class="flex-100 overflow-auto">   
            <center>
                <div class="filtros">
                    <h4 class="mb-0">Total en caja: </h4>
                    <div class="d-flex gap-4 align-items-center justify-content-center w-100">
                        <div class="w-25">
                            <p class="text-center total fw-600 form-control h-auto" id="total_total">0</p>
                            <button type="button" id="cerrarCaja" class="btn btn-success">Cerrar Caja</button>
                        </div>
                    </div>
                </div>  
            </center>       
            <div class="categorias mt-2 overflow-auto">

                <div class="tabla">
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>MONEDAS</h6>
                    </div>
                    <form class="body">
                        <table class="table" border="1px">
                            <thead class="table-default">
                                <th class="text-center w-auto">Monedas</th>
                                <th class="text-center w-75">Cantidad</th>
                                <th class="text-center w-50">Total</th>
                            </thead>
                            <tbody>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_50">50</td>
                                    <td class="text-center"><input type="number"  id="cantidad_50" class="form-control" placeholder="Monedas de 50"  name="cantidad_50"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_50" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_100">100</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Monedas de 100" id="cantidad_100" name="cantidad_100"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_100" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_200">200</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Monedas de 200" id="cantidad_200" name="cantidad_200"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_200" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_500">500</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Monedas de 500" id="cantidad_500" name="cantidad_500"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_500" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_1000">1000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Monedas de 1000" id="cantidad_1000" name="cantidad_1000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_1000" value="0"></td>
                                </tr>
                                <tr>
                                    <td class="text-center">TOTAL:</td>
                                    <td colspan="2" class="text-center" id="total_monedas"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tabla">    
                    <div class="head">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <h6>BILLETES</h6>
                    </div>
                    <form class="body">
                        <table class="table" border="1px">
                            <thead  class="table-default">
                                <th class="text-center">Billetes</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                            </thead>
                            <tbody>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_2000">2000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 2000" id="cantidad_2000" name="cantidad_2000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_2000" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_5000">5000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 5000" id="cantidad_5000" name="cantidad_5000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_5000" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_10000">10000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 10000" id="cantidad_10000" name="cantidad_10000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_10000" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_20000">20000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 20000" id="cantidad_20000" name="cantidad_20000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_20000" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_50000">50000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 50000" id="cantidad_50000" name="cantidad_50000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_50000" value="0"></td>
                                </tr>
                                <tr class="table-light">
                                    <td class="text-center" id="monto_100000">100000</td>
                                    <td class="text-center"><input type="number" class="form-control" placeholder="Billetes de 100000" id="cantidad_100000" name="cantidad_100000"></td>
                                    <td class="text-center total"><input class="form-control" type="number" readonly id="total_100000" value="0"></td>
                                </tr>
                                <tr>
                                    <td class="text-center">TOTAL:</td>
                                    <td colspan="2" class="text-center" id="total_billetes"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>  
        </div>
        <script src="../controller/totalCaja.js"></script>
        <script src="../controller/funcionesCaja.js"></script>
    </section>
    <script src="../libraries/animaciones.js"></script>
    <?php include('footer.php') ?>


    <?php
    
        } else {
            echo '<script>
                    alert("No se puede cerrar caja si no existe una caja activa")
                </script>';
        }

    ?>

  </body>
</html>

