<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../Config/Config.php");
    include_once("../../Model/Conector.php");
    include_once("../../Controller/autos.php");

try {
    $conn = new Connector();
    $db = $conn->getConectordb();
    $item = new Autos($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->placa = $data->placa;
    $item->vin = $data->vin;
    $item->linea = $data->linea;
    $item->cilindrada = $data->cilindrada;
    $item->color = $data->color;
    $item->chasis =  $data->chasis;
    
    $item->id_propietario=$data->id_propietario;
    $item->id_modelo=$data->id_modelo;
    $item->id_marca=$data->id_marca;
    $item->id_tipo=$data->id_tipo;

    
    if($item->setAutos()){
        echo 'Auto agregado.';
    } else{
        echo 'Auto no se pudo agregar.';
    }
} catch (PDOException $th) {
    echo $th;
}
   
?>