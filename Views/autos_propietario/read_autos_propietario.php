<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../Config/Config.php");
include_once("../../Model/Conector.php");
include_once("../../Controller/autos_propietario.php");

try {
    $con=new Connector();
    $db = $con->getConectordb();
    
    $autos = new Autos_Propietario($db);
    $autos->nombre=isset($_GET['nombre']) ? $_GET['nombre'] : die();
    $auto=$autos->obtenerDetallesAuto();

$itemCount = $auto->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $prop = array();
        $prop["body"] = array();
        $prop["itemCount"] = $itemCount;
        while ($row = $auto->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "nombre" => $nombre,
                "placa" => $placa,
                "color" => $color,
                "marca" => $marca,
            );
            array_push($prop["body"], $e);
        }
        echo json_encode($prop);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.",
            "error"=>"404")
        );
    }
} catch (PDOException $th) {
    echo $th;
}



?>