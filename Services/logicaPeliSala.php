<?php 
    require_once("../PruebaTecnica2.0/Repository/crudPeliSala.php");

    class logicaPeliSala {
        private $resPeliSala;

        public function __construct(){
            $this->resPeliSala = new crudPeliSala ();
        }

        //validaciones para la fecha y poder obtener las peliculas por ella
        public function ObtenerPeliFecha($fecha_publicacion) {
            if ($fecha_publicacion === "") {
                throw new Exception("Debe ingresar la fecha.");
            } else {
                $formato = 'Y-m-d';
                $d = DateTime::createFromFormat($formato, $fecha_publicacion);
                if (!($d && $d->format($formato) === $fecha_publicacion)) {
                    throw new Exception("Formato de fecha inválido. Use AAAA-MM-DD.");
                } else {
                    return $this->resPeliSala->Buscarfecha($fecha_publicacion);
                }
            }
        }

        /*validacion del nombre que no venga vacio y que se cumpla las condiciones establecidas que 
        se deben mostrar de acuerdo a la cantidad */
        public function ObtenerSalaNombre(string $nombre) {
            if ($nombre === "") {
                throw new Exception("Debe ingresar el nombre.");
            }
                $peliculasProyectadas = $this->resPeliSala->BuscarSala($nombre);
            
                    if ($peliculasProyectadas  < 3) {
                        $mensaje = "Sala Disponible";
                        return $mensaje;
                    } elseif ($peliculasProyectadas >= 3 && $peliculasProyectadas <= 5) {
                        $mensaje = "Sala con ".$peliculasProyectadas ." peliculas asignadas";
                        return $mensaje;
                    } elseif ($peliculasProyectadas > 5) {
                        $mensaje = "Sala no Disponible";
                        return $mensaje;
                    }
        }
    }
?>