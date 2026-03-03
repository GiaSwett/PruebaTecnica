<?php

class pelicula_salacine{
    private $id_salaCine;
    private $id_pelicula;
    private $fecha_publicacion;
    private $fecha_fin;

    public function __construct(){

    }

    public function getId_salaCine(){
        return $this->id_salaCine;
    }

    public function setId_salaCine($id_salaCine){
        $this->id_salaCine = $id_salaCine;

        return $this;
    }

    public function getId_pelicula(){
        return $this->id_pelicula;
    }

    public function setId_pelicula($id_pelicula){
        $this->id_pelicula = $id_pelicula;

        return $this;
    }

    public function getFecha_publicacion(){
        return $this->fecha_publicacion;
    }

    public function setFecha_publicacion($fecha_publicacion){
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    public function getFecha_fin(){
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin){
        $this->fecha_fin = $fecha_fin;

        return $this;
    }
}
?>