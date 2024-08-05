<?php  
    class consultas {
        private $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        function consultaUnica($consulta)
        {
            $respuesta = array(); // arreglo vacio para almacenar los datos que va a enviar a la base de datos

            $modulos = $this->conexion->prepare($consulta);
            $modulos->execute();

            $total = $modulos->rowCount(); // cantidad de datos encontrados
            if ($total > 0) {
                $a = 0;
                while ($data = $modulos->fetch(PDO::FETCH_ASSOC)) {
                    $respuesta[$a] = $data;
                    $a++;
                }
            }
            return $respuesta[0]['cant'];
        }

        function consultaMultiple($consulta){
            $respuesta = array(); // arreglo vacio para almacenar los datos que va a enviar a la base de datos

            $modulos = $this->conexion->prepare($consulta);
            $modulos->execute();

            $total = $modulos->rowCount(); // cantidad de datos encontrados
            if ($total > 0) {
                $a = 0;
                while ($data = $modulos->fetch(PDO::FETCH_ASSOC)) {
                    $respuesta[$a] = $data;
                    $a++;
                }
                return $respuesta;
            } else {
                return 0;
            }
        }
    }

?>