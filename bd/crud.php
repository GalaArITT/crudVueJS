<?php
//instanciar a conexion
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto -> Conectar();
//recibir con Axios
$_POST = json_decode(file_get_contents("php://input"), true);
//recepción de datos enviados con POST en el main.js
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : ''; //para el case

//datos de la tabla
//isset determina si una variable está definida y no es nula ? es para abreviar un if-else
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';

switch($opcion){
    case 1://alta
        $consulta = "INSERT INTO personas (nombre, sexo, edad) VALUES('$nombre', '$sexo', '$edad') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2://modificar
        $consulta = "UPDATE personas set nombre ='$nombre', sexo='$sexo',edad='$edad' where id ='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado ->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://borrar
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;   
    case 4://listar
        $consulta = "SELECT id, nombre, sexo, edad FROM personas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar array en $data en formato json a js 
$conexion = NULL; //cerrar conexion