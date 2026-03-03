<?php
    require_once ('../PruebaTecnica2.0/Controllers/controlPelicula.php');
    require_once ('../PruebaTecnica2.0/Controllers/controlPeliSala.php');
    require_once ('../PruebaTecnica2.0/Model/pelicula.php');
    require_once ('../PruebaTecnica2.0/Model/pelicula_salacine.php');

    $controlPeli = new controlPelicula();
    $controlPeliSala = new controlPeliSala();

            $metodo = $_SERVER['REQUEST_METHOD'];
            switch ($metodo) {
                case 'GET':
                    if (isset($_GET['id'])) {
                        $controlPeli->ListarPelId($_GET['id']);
                    } elseif(isset($_GET['nombre'])) {
                        $controlPeli->Buscar($_GET['nombre']);
                    } elseif (isset($_GET['fecha'])){
                        $controlPeliSala->ListarPeliFecha($_GET['fecha']);
                    } elseif (isset($_GET['nom'])){
                        $sala = $controlPeliSala->DisponibilidadSala($_GET['nom']);
                        echo $sala;
                    }else {
                        $controlPeli->ListarPel();
                    }
                    break;

                case 'POST':
                        $pel = new pelicula();
                        $dato  = json_decode(file_get_contents('php://input'),true);
                        $pel->setNombre($dato['nombre']);
                        $pel->setDuracion($dato['duracion']);

                        $controlPeli->InsertarPel($pel);
                    break;

                case 'PUT':
                    if (isset($_GET['id'])) {
                            $pel = new pelicula();
                            $dato  = json_decode(file_get_contents('php://input'),true);
                            $pel->setId_pelicula($_GET['id']);
                            $pel->setNombre ($dato['nombre']);
                            $pel->setDuracion($dato['duracion']);
                            $controlPeli->ModificarPeli($pel);
                    } else {
                        print ("No se puede modificar");
                    }
                    break;

                case 'DELETE':
                    if (isset($_GET['id'])) {
                        $controlPeli->EliminarPeli($_GET['id']);
                    }else {
                        print("No hay datos correspondientes a ese id");
                    }
                    break;                    
                default:
                    print "ERROR";
                    break;
            }
?>