<?php

use FFI\Exception;

    require_once("../PruebaTecnica2.0/Services/logicaPelicula.php");
    require_once ("../PruebaTecnica2.0/Model/pelicula.php");

    class controlPelicula {
        private $servPeli;

        public function __construct(){
            $this->servPeli = new logicaPelicula();
        }

        //
        public function ListarPel() {
                $pelicula = $this->servPeli->ObtenerPeli();
                
                if (is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        echo json_encode($pelicula);
                    } else {
                        echo json_encode(["mensaje" => "No hay películas registradas"]);
                    }
                } else {
                    echo json_encode(["A OCURRIDO UN ERROR AL TRAER LOS DATOS"]);
                }
        }

        public function ListarPelId(int $id_pelicula) {
            try {
                    $pelicula = $this->servPeli->ObtenerPeliId($id_pelicula);
                    print json_encode($pelicula);
                
            } catch (Exception $e) {
                echo json_encode(["Ocurrio un problema en el servidor" => $e->getMessage()]);
            }
        }

        public function InsertarPel(pelicula $pelicula) {
            try {
                return $this->servPeli->NuevaPeli($pelicula);
                echo json_encode(["mensaje" => "Película creada correctamente"]);
            } catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        }

        public function ModificarPeli(pelicula $pelicula) {            
            try {
                return $this->servPeli->ModificarPeli($pelicula);
                echo json_encode(["mensaje" => "Película modificada correctamente"]);
            }catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            
        }

        public function EliminarPeli(int $id_pelicula) {
            try {
                return $this->servPeli->EliminarPeliculas($id_pelicula);
                echo json_encode(["mensaje" => "Película modificada correctamente"]);
            }catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        }

        public function Buscar (string $nombre){
            $pelicula = $this->servPeli->BuscarPorNombre($nombre);

            if (is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        print json_encode($pelicula);
                    } else {
                        echo json_encode(["NO SE ENCONTRARON DATOS"]);
                    }
                } else {
                    echo json_encode(["A OCURRIDO UN ERROR AL TRAER LOS DATOS"]);
                }
        }
    }   
?>