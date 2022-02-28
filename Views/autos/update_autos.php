<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
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
    $item->id= isset($_GET['id']) ? $_GET['id'] : die();;
    $item->placa = $data->placa;
    $item->vin = $data->vin;
    $item->linea = $data->linea;
    $item->cilindrica = $data->cilindrica;
    $item->color = $data->color;
    $item->chasis =  $data->chasis;

    $item->id_auto=$data->id_auto;
    $item->id_propietario=$data->id_propietario;
    $item->id_modelo=$data->id_modelo;
    $item->id_marca=$data->id_marca;
    $item->id_tipo=$data->id_tipo;
   
    
    if($item->updateDetallesAutos()){
        echo 'auto actualizado.';
       
    } else{
        echo 'auto no se pudo agregar.';
    }
} catch (PDOException $th) {
    echo $th;
}

   
?>
