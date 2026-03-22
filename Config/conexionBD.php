<?php
    require_once (__DIR__.'/../vendor/autoload.php');
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;
    use Doctrine\DBAL\DriverManager;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
    $dotenv->load();
    
    class conexionBD{
        //variables de conexion
        public $conex;

        //conexión a la base de datos
        public function conector(){
            $this -> conex = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
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

        function IniciarEntityManager(){
            $conf = ORMSetup::createAttributeMetadataConfig([__DIR__.'/../src/Model']); //esta funcion nos ayuda a que se establezca una conexion entre la clase mapeada y pueda ayudar a sea más facil poder prepararlas para la base de datos
            $conf->setProxyDir(__DIR__.'/../vendor/Proxies'); //ruta donde se almacenaran las clases proxie
            $conf->setProxyNamespace('Proxies'); //nombre de las clases proxie
            $conf->setAutoGenerateProxyClasses(true);
            $conx = DriverManager::getConnection(array('driver' => 'pdo_mysql', 'user' => $_ENV['DB_USER'], 'password' => $_ENV['DB_PASS'],
                            'host' => $_ENV['DB_HOST'], 'dbname' => $_ENV['DB_NAME']));
            
            $entityManager = new EntityManager($conx, $conf);
            return $entityManager;
        }
    }
?>