<?php
    require_once ("../PruebaTecnica2.0/Repository/crudPelicula.php");
    require_once ("../PruebaTecnica2.0/Model/pelicula.php");

    class logicaPelicula{
        //variable que nos ayudara a llamar a las funciones del CRUD
        private $resPel;

        //En este constructor se especifica que es una instancia de la clase crudPelicula
        public function __construct() {
            $this->resPel = new crudPelicula();
        }

        //Metodo que nos dice si hay datos y los muestra caso contrario nos salta un error
        public function ObtenerPeli() : array {
            $peliculas = $this->resPel->Obtener();

            if (empty($peliculas)) {
                throw new Exception("No hay datos en la tabla");
            }               
            return $peliculas;
        }

        /**
         * Función para obtener por id
         * @param [integer] $id_pelicula
         * @return void
         * 
         * esta función nos devuelve los datos especificos de una pelicula mediante el ID, nos tira el error
         * en caso de que el ID ingresado no contenga un dato.
         */
        public function ObtenerPeliId($id_pelicula) {
            if ($id_pelicula <= 0) {
                throw new Exception("El ID inválido.");
            }else {
                $pelicula = $this->resPel->ObtenerId($id_pelicula);
            }
            return $pelicula;
        }

        public function NuevaPeli(pelicula $pelicula) {
            $peliculaexiste = $this->resPel->BuscarNombre($pelicula->getNombre());
            
            if (empty($pelicula->getNombre()) || empty($pelicula->getDuracion())) {
                throw new Exception("Los campos no pueden ir vacios");
            } if ($peliculaexiste) 
                throw new Exception("Pelicula existente en la base de datos");
            else {
                $this->resPel->InsertarPel($pelicula);
            }
        }

        public function ModificarPeli(pelicula $pelicula) {
            $existe = $this->resPel->ObtenerId($pelicula->getId_pelicula());

            if (!$existe) {
                throw new Exception("ID no existe");
            } elseif ($pelicula->getNombre()==="" || $pelicula->getDuracion()=== "") {
                throw new Exception("Los campos no pueden ir vacios");
            } else {
                $this->resPel->ActualizarPel($pelicula);
            }
        }

        public function EliminarPeliculas(int $id_pelicula) {
                
            if ($id_pelicula <= 0) {
                throw new Exception("ID inválido");
            } else {
                $this->resPel->EliminarPel($id_pelicula);
            }
        }

        public function BuscarPorNombre(string $nombre) {
            if ($nombre === "") {
                throw new Exception("No puede estar vacio nombre");
            }
            return $this->resPel->BuscarNombre($nombre);
        }
    }
?>