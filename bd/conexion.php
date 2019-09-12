<?php 
    class Conexion {
        public static function Conectar(){
            define('servidor', 'localhost'); //servidor
            define('nombre_bd', 'crudvuejs'); //nombre de la base de datos
            define('usuario', 'root'); // usuario
            define('password', ''); //password
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
                return $conexion;
            }catch (Exception $e){
                die("Fallo en conexión: ". $e->getMessage());
            }
        }
    }

?>
