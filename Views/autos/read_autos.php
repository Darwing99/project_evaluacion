<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../../Config/Config.php");
include_once("../../Model/Conector.php");
include_once("../../Controller/autos.php");
try {
    
$con=new Connector();
$db = $con->getConectordb();

$auto = new Autos($db);
$query="select*from tbl_auto";
$items = $auto->obtenerDatos($query);
$itemCount = $items->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $prop = array();
        $prop["body"] = array();
        $prop["itemCount"] = $itemCount;
        while ($row = $items->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "placa"=>$placa,
                "vin"=>$vin,
                "linea"=>$linea,
                "cilindrada"=>$cilindrada,
                "color"=>$color,
                "chasis"=>$chasis
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