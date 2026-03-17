<?php 
require_once("../PruebaTecnica2.0/Services/logicaPeliSala.php");

    class controlPeliSala {
        private $serPeliSala;
        
        //instancia del objecto que nos permitira acceder las funciones de la lógica
        public function __construct(){
            $this->serPeliSala = new logicaPeliSala();
        }

        /**
         * Undocumented function
         *
         * @param [type] $fecha_publicacion
         * @return void
         * 
         * esta función permite evaludar que los datos que van a traer mediante la fecha sean correctos, se traen
         * mediante un array que se evalua la cantidad de datos para que se pueda mostrar los datos o dar errores en caso de que
         * ven vacios.
         */
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

        /**
         * Undocumented function
         *
         * @param string $nombre
         * @return void
         * 
         * esta función permite traer los datos de la sala y da un error en caso de que al llamar a la función del servicio
         * no muestre los datos con las salidas esperadas.
         */
        public function DisponibilidadSala(string $nombre){
            try {
            return $this->serPeliSala->ObtenerSalaNombre($nombre);
            } catch (Exception $e) {
            return ["Hubo un problema al traer los datos" => $e->getMessage()];
            }
        }
    }
?>