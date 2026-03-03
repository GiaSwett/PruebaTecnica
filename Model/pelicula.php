<?php
class pelicula {
    //atributos de la clase pelicula
    private $id_pelicula;
    private  $nombre;
    private $duracion;

    //nos permite crear objetos con los datos de la clase
    public function __construct(){

    }

    //getter y setter (mostrar y modificar los datos de la clase) 
    public function getId_pelicula(){
        return $this->id_pelicula;
    }

    public function setId_pelicula($id_pelicula){
        $this->id_pelicula = $id_pelicula;

        return $this;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    public function getDuracion(){
        return $this->duracion;
    }
    

    public function setDuracion($duracion){
        $this->duracion = $duracion;

        return $this;
    }
}
?>