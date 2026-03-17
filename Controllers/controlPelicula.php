<?php
use OpenApi\Annotations as OA;
use FFI\Exception;

    require_once("../PruebaTecnica2.0/Services/logicaPelicula.php");
    require_once ("../PruebaTecnica2.0/Model/pelicula.php");

    class controlPelicula {
        private $servPeli;

        public function __construct(){
            $this->servPeli = new logicaPelicula();
        }

        /**
         * @OA\GET(
         *  summary = Listado de peliculas alojadas en la DB
         *  description="Muestra los datos que se encuentran alojados en la tabla Pelicula", 
         *  @OA\Response( 
         *      response=200, 
         *      description = Muestra el arreglo con los datos, 
         *      @OA\Response( 
         *          response=400,
         *          description = Mensaje de error => Ocurrio un error al traer lo datos,
         *          @OA\Items(
         *              @OA\Property(property="id_pelicula", type="integer"),
         *              @OA\Property(property="nombre", type="string"),
         *              @OA\Property(property="duracion", type="integer"),
         *             )
         *          )
         *      )
         *  )
         */
        public function ListarPel() {
                $pelicula = $this->servPeli->ObtenerPeli();
                
                if (is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        header('Content-Type: application/json'); 
                        echo json_encode($pelicula);
                    } else {
                        echo json_encode(["Error" => "No hay películas registradas"]);
                    }
                } else {
                    echo json_encode(["Error" => "A OCURRIDO UN ERROR AL TRAER LOS DATOS"]);
                }
        }

        /**
         *  @OA\GET(
         *     path = "/id"
         *     summary = Filtro de pelicula por Id
         *     description="Muestra datos especificos al hacer una busqueda mediante el Id", 
         *     @OA\Response( 
         *          response=200, 
         *          description = Muestra los datos que correspondan a ese Id, 
         *      ),
         *      @OA\Response(
         *           response=400,
         *           description = Mensaje de error,
         *      )
         *  )
         */
        public function ListarPelId(int $id_pelicula) {
            try {
                    $pelicula = $this->servPeli->ObtenerPeliId($id_pelicula); 
                    echo json_encode ($pelicula);
                
            } catch (Exception $e) {
                echo json_encode(["Ocurrio un problema en el servidor" => $e->getMessage()]);
            }
        }

        /** 
         * @OA\Post( 
         *      summary="Inserta una nueva pelicula", 
         *      description="Inserta una nueva pelicula a la tabla correspondiente", 
         *      @OA\RequestBody( 
         *          content= application/json, 
         *          required=true, 
         *          @OA\MediaType( 
         *              mediaType="application/json",                  
         *              @OA\Schema(ref="#/components/parameters/token") 
         *          ) 
         *      ), 
         *      @OA\Response( 
         *          response=200, 
         *          description="Pelicula creada correctamente", 
         *      ), 
         *      @OA\Response( 
         *          response=404, 
         *          description="Mensaje de error" 
         *      )    
         *  ) 
         */
        public function InsertarPel(pelicula $pelicula) {
            try {
                return $this->servPeli->NuevaPeli($pelicula);
                echo json_encode(["mensaje" => "Película creada correctamente"]);
            } catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        }

        /** 
         * @OA\PUT( 
         *      summary="Modificar una pelicula existente en la BD", 
         *      description="Se puede modificar el nombre y la duración de una pelicula que se encuentre disponible en la base de datos", 
         *      @OA\RequestBody( 
         *          content= application/json, 
         *          required=true, 
         *          @OA\MediaType( 
         *              mediaType="application/json",                  
         *              @OA\Schema(ref="#/components/parameters/token") 
         *          ) 
         *      ), 
         *      @OA\Response( 
         *          response=200, 
         *          description="Pelicula modificada correctamente", 
         *      ), 
         *      @OA\Response( 
         *          response=404, 
         *          description="Mensaje de error" 
         *      )    
         *  ) 
         */
        public function ModificarPeli(pelicula $pelicula) {            
            try {
                return $this->servPeli->ModificarPeli($pelicula);
                echo json_encode(["mensaje" => "Película modificada correctamente"]);
            }catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            
        }

        /**
         *  @OA\DELETE(
         *     path = "/id"
         *     summary = Eliminación de peliculas
         *     description="Eliminación lógica, ya que solo cambia el estado de la pelicula de disponible a no disponible", 
         *     @OA\Response( 
         *          response=200, 
         *          description = "Pelicula Eliminada correctamente", 
         *      ),
         *      @OA\Response(
         *           response=400,
         *           description = Mensaje de error,
         *      )
         *  )
         */
        public function EliminarPeli(int $id_pelicula) {
            try {
                return $this->servPeli->EliminarPeliculas($id_pelicula);
                echo json_encode(["mensaje" => "Película eliminada correctamente"]);
            }catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        }

        /**
         *  @OA\GET(
         *     path = "/nombre"
         *     summary = Filtro de pelicula por nombre
         *     description="Muestra datos especificos al hacer una busqueda mediante el nombre", 
         *     @OA\Response( 
         *          response=200, 
         *          description = Muestra los datos que correspondan a al nombre que se especifico, 
         *      ),
         *      @OA\Response(
         *           response=400,
         *           description = Mensaje de error,
         *      )
         *  )
         */
        public function Buscar (string $nombre){
            $pelicula = $this->servPeli->BuscarPorNombre($nombre);

            if (is_array($pelicula)) {
                    if (sizeof($pelicula) > 0) {
                        print json_encode($pelicula);
                    } else {
                        echo json_encode(["error" =>"NO SE ENCONTRARON DATOS"]);
                    }
                } else {
                    echo json_encode(["error" =>  "A OCURRIDO UN ERROR AL TRAER LOS DATOS"]);
                }
        }
    }   
?>