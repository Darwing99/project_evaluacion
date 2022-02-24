<?php
class Modelos{
    private $conn;
    public $id;
    private $table="tbl_modelo";
    public $modelo;
    public $descripcion;
   


    public function __construct($db){
        $this->conn = $db;
    }

    public function obtenerDatos(){
        $query="select*from tbl_modelo";
        $result=$this->conn->prepare($query);
        $result->execute();
        return $result;
    
       }


    public function setData($sqlQuery){
        $result = $this->conn->prepare($sqlQuery);

        $this->modelo=htmlspecialchars(strip_tags($this->modelo));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
       
        
        $result->bindParam(1,$this->modelo);
        $result->bindParam(2, $this->descripcion);
        return $result;
  
    }
    public function setModelo(){
            $sqlQuery = "INSERT INTO ".$this->table."(modelo,descripcion) values(?,?)";

            $result = $this->setData($sqlQuery);
           
            return $result->execute()? true:false;
          
    }

    public function updateModelo(){
        $sqlQuery = "UPDATE  ".$this->table." SET modelo=?,descripcion=? WHERE id=".$this->id;

        $result = $this->setData($sqlQuery);
           
        return $result->execute()? true:false;
    }

    //Funcion para eliminar modelos de vehiculo
    public function deleteModelo(){
        $sqlQuery = "DELETE FROM ".$this->table."  WHERE id=".$this->id;

            $result = $this->conn->prepare($sqlQuery);
       

            return $result->execute()? true:false;
    }
}


?>