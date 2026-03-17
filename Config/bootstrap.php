<?php 
    require_once (__DIR__ . '/../vendor/autoload.php');
    use Doctrine\DBAL\DriverManager;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Configuration;

    $connection = DriverManager::getConnection([
        'dbname'   => 'cine',
        'user'     => 'Itati_prueba',
        'password' => 'Proy2123',
        'host'     => 'localhost',
        'driver'   => 'pdo_mysql',
    ]);

    $config = new Configuration();
    $paths = [__DIR__ . '/../Model/Pelicula'];

    $entityManager = new EntityManager($connection, $config);   
?>