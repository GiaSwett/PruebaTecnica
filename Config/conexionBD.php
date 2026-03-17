<?php
    class conexionBD{
        //variables para la conexión
        private $host = "localhost";
        private $usuario = "Itati_prueba";
        private $clave = "Proy2123";
        private $puerto = 3306;
        private $db = "cine";
        public $conex;

        //conexión a la base de datos
        public function conector(){
            $this -> conex = mysqli_connect($this ->host, $this ->usuario, $this ->clave, $this ->db, $this ->puerto);
            if (mysqli_connect_error()) {
            printf("Hubo un error al momento de hacer la conexión %d",mysqli_connect_error());
            exit;
            } else {
                return $this->conex;
            }
        }

        //función para ejecutar consultas y que no vengan vacias
        public function query($q){
            $data = array();
            if($q != ""){
                if ($r = mysqli_query($this->conex, $q)) {
                    $data = mysqli_fetch_assoc($r);
                        $data[] = $r;
                }
            }
            return $data;
        }
    }
?>