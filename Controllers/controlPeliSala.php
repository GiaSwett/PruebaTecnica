<?php 
require_once("../PruebaTecnica2.0/Services/logicaPeliSala.php");

    class controlPeliSala {
        private $serPeliSala;
        
        public function __construct(){
            $this->serPeliSala = new logicaPeliSala();
        }

        public function ListarPeliFecha($fecha_publicacion){
                $peliculas=$this->serPeliSala->ObtenerPeliFecha($fecha_publicacion);

                if (is_array($peliculas)) {
                    if (sizeof($peliculas) > 0) {
                        echo json_encode($peliculas);
                    } else {
                        echo json_encode (["Mensaje" => "NO SE ENCONTRARON DATOS"]);
                    }
                } else {
                    echo json_encode (["Mensaje" => "A OCURRIDO UN ERROR AL TRAER LOS DATOS"]);
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