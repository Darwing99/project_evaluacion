<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../Config/Config.php");
    include_once("../../Model/Conector.php");
    include_once("../../Controller/tipo_autos.php");
try {
    $conn = new Connector();
    $db = $conn->getConectordb();
    $item = new TipoAutos($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->tipo = $data->tipo;
    $item->descripcion = $data->descripcion;

    
    if($item->setTipo()){
        echo 'tipo auto agregado.';
    } else{
        echo 'tipo auto no se pudo agregar.';
    }
} catch (PDOException $th) {
    echo $th;
}

  
?>