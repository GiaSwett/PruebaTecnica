<?php 
    require_once("../PruebaTecnica2.0/Config/conexionBD.php");
    require_once("../PruebaTecnica2.0/Model/pelicula_salacine.php");
    
    Class crudPeliSala {
        //atributos
        private $conn;

        public function __construct(){
            $bd = new conexionBD ();
            $this->conn = $bd->conector();
        }

        //Presentar peliculas por fecha
        public function Buscarfecha ($fecha_publicacion) {
            $peliculasFecha = [];
            //consulta para buscar por fecha
            $buscarfecha = $this->conn->prepare("SELECT p.id_pelicula, p.nombre, p.duracion, ps.fecha_publicacion
                                                    FROM pelicula p INNER JOIN pelicula_salacine ps 
                                                    ON p.id_pelicula = ps.id_pelicula
                                                    WHERE ps.fecha_publicacion = ?;");
            $buscarfecha->bind_param("s", $fecha_publicacion);
            $buscarfecha->execute();
            $parametro = $buscarfecha->get_result();

            if ($r = $parametro->fetch_all()) {
                $peliculasFecha = $r;
            }
            return $peliculasFecha;
        }


        //Buscar por el nombre de la sala de cine y contar las peliculas que proyectan
        public function BuscarSala (string $nombreSala) {
            //consulta para buscar por nombre
            $buscarSala = $this->conn->prepare("SELECT COUNT(ps.id_pelicula) AS peliculas_proyectadas 
                                                FROM cine.pelicula_salacine ps INNER JOIN sala_cine sc
                                                ON ps.id_salaCine = sc.id_sala WHERE sc.nombre = ?;");
            $buscarSala->bind_param("s", $nombreSala);
            $buscarSala->execute();
            $parametro = $buscarSala->get_result();
            $peliculasTotal = $parametro->fetch_assoc();
            return $peliculasTotal['peliculas_proyectadas'];
        } 
    }
?>