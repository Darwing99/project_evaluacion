<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../Config/Config.php");
    include_once("../../Model/Conector.php");
    include_once("../../Controller/propietarios.php");


    $conn = new Connector();
    $db = $conn->getConectordb();
    $item = new Propietarios($db);
    $data = json_decode(file_get_contents("php://input"));
    
    $item->nombre = $data->nombre;
    $item->apellido = $data->apellido;
    $item->identificacion = $data->identificacion;
    $item->direccion = $data->direccion;
    $item->fecha_nacimiento = $data->fecha_nacimiento;
    $item->telefono =  $data->telefono;
    $item->email =  $data->email;
    
    if($item->setPropietarios()){
        echo 'Propietario agregado.';
    } else{
        echo 'Propietario no se pudo agregar.';
    }
?>