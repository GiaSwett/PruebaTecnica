<?php 
require_once("../PruebaTecnica2.0/Services/logicaPeliSala.php");

    class controlPeliSala {
        private $serPeliSala;
        
        public function __construct(){
            $this->serPeliSala = new logicaPeliSala();
        }

        public function ListarPeliFecha($fecha_publicacion){
                $fecha=$this->serPeliSala->ObtenerPeliFecha($fecha_publicacion);

                if ((gettype($fecha) === 'array') && is_array($fecha)) {
                    if (sizeof($fecha) > 0) {
                        print json_encode($fecha);
                    } else {
                        print "NO SE ENCONTRARON DATOS";
                    }
                } else {
                    print "A OCURRIDO UN ERROR AL TRAER LOS DATOS";
                }
        }

        public function DisponibilidadSala(string $nombre){
            try {
            return $this->serPeliSala->ObtenerSalaNombre($nombre);
            } catch (Exception $e) {
            return ["Hubo un problema al traer los datos" => $e->getMessage()];
            }
        }
    }
?>