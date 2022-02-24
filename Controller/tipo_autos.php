<?php
class TipoAutos{
    private $conn;
    public $id;
    private $table="tbl_tipo_vehiculo";
    public $tipo;
    public $descripcion;
   


    public function __construct($db){
        $this->conn = $db;
    }

    public function setData($sqlTipo){

        $result = $this->conn->prepare($sqlTipo);

        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
       
        
        $result->bindParam(1,$this->tipo);
        $result->bindParam(2, $this->descripcion);
        return $result;
  

    }
    public function obtenerDatos(){
        $sqlTipo="SELECT*FROM ".$this->table;
        $result=$this->conn->prepare($sqlTipo);
        $result->execute();
        return $result;
    
       }


    public function setTipo(){
        $sqlQuery = "INSERT INTO ".$this->table."(tipo,descripcion) VALUES(?,?)";
        $result=$this->setData($sqlQuery);
        return $result->execute()?true:false;
    }


    public function updateTipo(){
        $sqlQuery = "UPDATE  ".$this->table." SET tipo=?,descripcion=? WHERE id=".$this->id;

        $result=$this->setData($sqlQuery);
        return $result->execute()?true:false;
    }

    
    public function deleteTipo(){
        $sqlQuery = "DELETE FROM ".$this->table."  WHERE id=".$this->id;

            $result = $this->conn->prepare($sqlQuery);

            return $result->execute()?true:false;
    }
}


?>