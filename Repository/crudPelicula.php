<?php
    require_once("../PruebaTecnica2.0/Config/conexionBD.php");
    require_once("../PruebaTecnica2.0/Model/pelicula.php");

    class crudPelicula {
        private $con;

        //este contructor nos permite establecer la variable definida lleve la conexion con la BD
        public function __construct(){
            $base = new conexionBD();
            $this->con = $base->conector();
        }

        //obtener los datos de la base de datos de la tabla pelicula
        public function Obtener(): array {
            $peliculas = [];
            //consulta sql para obtener todos los datos
            $resul = $this->con->query("SELECT id_pelicula, nombre, duracion FROM pelicula  WHERE estado = 'D'");

            while ($r = $resul->fetch_all()) {
                $peliculas = $r;
            }
            return $peliculas;
        }

        //obtener los datos de la base de datos de la tabla pelicula cuando se busque por el id de la misma
        public function ObtenerId(int $id_pelicula) {
            $peliculas = [];
            //consulta sql buscar por id
            $resul = $this->con->prepare("SELECT id_pelicula, nombre, duracion FROM pelicula WHERE id_pelicula = ?");
            $resul->bind_param("i", $id_pelicula);
            $resul->execute();
            $parametro = $resul->get_result();

            if ($r = $parametro->fetch_assoc()) {
                $peliculas = $r;
            }
            return $peliculas;
        }

        //Insertar los datos en la tabla pelicula
        public function InsertarPel(pelicula $pelicula) {
            //consulta sql para guardar datos
            $guardar = $this->con->prepare("INSERT INTO pelicula (nombre, duracion) VALUES (?, ?)");
            $nombre = $pelicula->getNombre();
            $duracion = $pelicula->getDuracion();
            $guardar->bind_param("si", $nombre, $duracion);
            $guardar->execute();
            return $guardar;
        }

        //Actualizaer los datos de la tabla pelicula
        public function ActualizarPel(pelicula $pelicula) {
            //consulta sql para actualizar datos
            $actu = $this->con->prepare("UPDATE pelicula SET nombre = ?, duracion = ? WHERE id_pelicula = ?");
            $nombre = $pelicula->getNombre();
            $duracion = $pelicula->getDuracion();
            $id =$pelicula->getId_pelicula();
            $actu->bind_param("sii", $nombre, $duracion, $id);
            $actu->execute();
            
            return $actu;
        }

        //Eliminar datos 
        public function EliminarPel(int $id_pelicula) {
            //consulta para eliminar datos
            $eliminar = $this->con->prepare("CALL EliminacionLogicaPelicula(?)");
            $eliminar->bind_param("i", $id_pelicula);
            $eliminar->execute();
            return $eliminar;
        }

        //buscar por nombre
        public function BuscarNombre (string $nombre) {
            $peliculas = [];
            //consulta para buscar por nombre
            $buscar = $this->con->prepare("SELECT id_pelicula, nombre, duracion FROM pelicula where nombre = ?");
            $buscar->bind_param("s", $nombre);
            $buscar->execute();
            $parametro = $buscar->get_result();

            if ($r = $parametro->fetch_assoc()) {
                $peliculas = $r;
            }
            return $peliculas;
        }
    }
?>