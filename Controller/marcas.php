<?php
class Marcas{
    private $conn;
    public $id;
    private $table="tbl_marca";
    public $marca;
    public $descripcion;
   


    public function __construct($db){
        $this->conn = $db;
    }

    public function obtenerDatos(){
        $query="select*from tbl_marca";
        $result=$this->conn->prepare($query);
        $result->execute();
        return $result;
    
       }


    public function setData($sqlQuery){
        $result = $this->conn->prepare($sqlQuery);

        $this->marca=htmlspecialchars(strip_tags($this->marca));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
       
        
        $result->bindParam(1,$this->marca);
        $result->bindParam(2, $this->descripcion);
        return $result;
  
    }
    public function setMarca(){
            $sqlQuery = "INSERT INTO ".$this->table."(marca,descripcion) values(?,?)";

            $result = $this->setData($sqlQuery);
           
            return $result->execute()? true:false;
          
    }

    public function updateMarca(){
        $sqlQuery = "UPDATE  ".$this->table." SET marca=?,descripcion=? WHERE id=".$this->id;

        $result = $this->setData($sqlQuery);
           
        return $result->execute()? true:false;
    }

    //Funcion para eliminar modelos de vehiculo
    public function deleteMarca(){
        $sqlQuery = "DELETE FROM ".$this->table."  WHERE id=".$this->id;

            $result = $this->conn->prepare($sqlQuery);
       

            return $result->execute()? true:false;
    }
}


?>