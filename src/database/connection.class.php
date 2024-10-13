<?php
    class Connection
    {
        public static function make()
        {
            try {
                $opciones = [
                    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_PERSISTENT => true 
                ];
                $connection = new PDO (
                    'mysql:host=alejandro.local;dbname=cursophp;charset=utf8',
                    'usercurso',
                    'php',
                    $opciones
                );
            }
            catch (PDOException $PDOException) {
                die("Error de conexión a la base de datos: " . $PDOException->getMessage());
            }

            return $connection;
        }
    }
?>