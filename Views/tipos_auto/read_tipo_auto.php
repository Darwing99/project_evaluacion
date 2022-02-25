<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../Config/Config.php");
include_once("../../Model/Conector.php");
include_once("../../Controller/tipo_autos.php");
try {
    
$con=new Connector();
$db = $con->getConectordb();

$tipoauto = new TipoAutos($db);

$items = $tipoauto->obtenerDatos();

$itemCount = $items->rowCount();
 
    if($itemCount > 0){
        
        $prop = array();
        $prop["body"] = array();
        $prop["itemCount"] = $itemCount;
        while ($row = $items->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "tipo" => $tipo,
                "descripcion" => $descripcion,
               
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