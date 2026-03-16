<?php 
    require_once("../PruebaTecnica2.0/Services/logicaPelicula.php");
    require_once ("../PruebaTecnica2.0/Model/pelicula.php");

    class controlPelicula {
        private $servPeli;

        public function __construct(){
            $this->servPeli = new logicaPelicula();
        }

        public function ListarPel() {
                $pelicula = $this->servPeli->ObtenerPeli();
                
                if ((gettype($pelicula) === 'array') && is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        print json_encode($pelicula);
                    } else {
                        print "NO SE ENCONTRARON DATOS";
                    }
                } else {
                    print "A OCURRIDO UN ERROR AL TRAER LOS DATOS";
                }
        }

        public function ListarPelId(int $id_pelicula) {
            try {
                    $pelicula = $this->servPeli->ObtenerPeliId($id_pelicula);
                    print json_encode($pelicula);
                
            } catch (Exception $ex) {
                print "Ocurrio un problema en el servidor";
            }
        }

        public function InsertarPel(pelicula $pelicula) {
            
        if (empty($pelicula->getNombre()) && empty($pelicula->getDuracion())) {
                echo "Los datos vacíos no se pueden mandar";
                
            } else {
                $pelicula = $this->servPeli->NuevaPeli($pelicula);
                return $pelicula;
            }
        }

        public function ModificarPeli(pelicula $pelicula) {            
            return $this->servPeli->ModificarPeli($pelicula);
        }

        public function EliminarPeli(int $id_pelicula) {
            return $this->servPeli->EliminarPeliculas($id_pelicula);
        }

        public function Buscar (string $nombre){
            $pelicula = $this->servPeli->BuscarPorNombre($nombre);

            if ((gettype($pelicula) === 'array') && is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        print json_encode($pelicula);
                    } else {
                        echo "NO SE ENCONTRARON DATOS";
                    }
                } else {
                    echo "A OCURRIDO UN ERROR AL TRAER LOS DATOS";
                }
        }
    }   
?>