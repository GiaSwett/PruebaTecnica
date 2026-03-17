<?php
    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: "Pelicula")]
class pelicula {
    //atributos de la clase pelicula
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id_pelicula;
    #[ORM\Column(type: "string")]
    private  $nombre;
    #[ORM\Column(type: "integer")]
    private $duracion;

    //nos permite crear objetos con los datos de la clase
    public function __construct(){}

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