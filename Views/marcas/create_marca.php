<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../Config/Config.php");
    include_once("../../Model/Conector.php");
    include_once("../../Controller/marcas.php");
try {
    $conn = new Connector();
    $db = $conn->getConectordb();
    $item = new Marcas($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->marca = $data->marca;
    $item->descripcion = $data->descripcion;

    
    if($item->setMarca()){
        echo 'marca agregada.';
    } else{
        echo 'marca no se pudo agregar.';
    }
} catch (PDOException $th) {
    echo $th;
}

  
?>