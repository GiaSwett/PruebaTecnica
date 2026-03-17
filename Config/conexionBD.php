<?php
    require_once (__DIR__ . '/../vendor/autoload.php');
    use Doctrine\ORM\Configuration;
    use Doctrine\ORM\EntityManager;
    use Doctrine\DBAL\DriverManager;
    use Doctrine\ORM\Mapping\Driver\AttributeDriver;

    class conexionBD{
        //variables para la conexión
        private $host = "localhost";
        private $usuario = "Itati_prueba";
        private $clave = "Proy2123";
        private $puerto = 3306;
        private $db = "cine";
        public $conex;

        //conexión a la base de datos
        public function conector(){
            $this -> conex = mysqli_connect($this ->host, $this ->usuario, $this ->clave, $this ->db, $this ->puerto);
            if (mysqli_connect_error()) {
            printf("Hubo un error al momento de hacer la conexión %d",mysqli_connect_error());
            exit;
            } else {
                return $this->conex;
            }
        }

        //función para ejecutar consultas y que no vengan vacias
        public function query($q){
            $data = array();
            if($q != ""){
                if ($r = mysqli_query($this->conex, $q)) {
                    $data = mysqli_fetch_assoc($r);
                        $data[] = $r;
                }
            }
            return $data;
        }

        public function inicializarEntityManager(){
            $paths = [__DIR__ . '/../src/Model'];

            $config = new Configuration();
            $driver = new AttributeDriver($paths);
            $config->setMetadataDriverImpl($driver);

            $connection = DriverManager::getConnection([
                'dbname'   => $this->db,
                'user'     => $this->usuario,
                'password' => $this->clave,
                'host'     => $this->host,
                'driver'   => 'pdo_mysql',
            ]);

            $entityManager = new EntityManager($connection, $config);
            return $entityManager;
        }
    }
?>