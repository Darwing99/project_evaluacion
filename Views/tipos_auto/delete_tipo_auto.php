<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../Config/Config.php");
    include_once("../../Model/Conector.php");
    include_once("../../Controller/tipo_autos.php");

try {
    $conn = new Connector();
    $db = $conn->getConectordb();
    $item = new TipoAutos($db);
    
    $item->id= isset($_GET['id']) ? $_GET['id'] : die();
   
    
    if($item->deleteTipo()){
        echo 'tipo auto  borrado.';
    } else{
        echo 'tipo auto no se pudo borrar.';
    }
} catch (PDOException $th) {
    echo $th;
}
   
?>