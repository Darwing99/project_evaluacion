<?php

class Propietarios{

    private $conn;
    public $id;
    private $table="tbl_propietario";
    public $nombre;
    public $apellido;
    public $identificacion;
    public $direccion;
    public $fecha_nacimiento;
    public $telefono;
    public $email;


    public function __construct($db){
        $this->conn = $db;
    }

    public function obtenerDatos(){
        $sqlPropietarios="select*from tbl_propietario";
        $result=$this->conn->prepare($sqlPropietarios);
        $result->execute();
        return $result;
    
       }

    public function setData($sqlQuery){
        $result = $this->conn->prepare($sqlQuery);

        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->identificacion=htmlspecialchars(strip_tags($this->identificacion));
        $this->fecha_nacimiento=htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->email=htmlspecialchars(strip_tags($this->email));

        $result->bindParam(1,$this->nombre);
        $result->bindParam(2, $this->apellido);
        $result->bindParam(3, $this->identificacion);
        $result->bindParam(4, $this->fecha_nacimiento);
        $result->bindParam(5, $this->direccion);
        $result->bindParam(6, $this->telefono);
        $result->bindParam(7, $this->email);
        return $result;
    }


    public function setPropietarios(){
        $sqlQuery = "INSERT INTO ".$this->table."(nombre,apellido,identificacion,fecha_nacimiento,direccion,telefono,email) VALUES(?,?,?,?,?,?,?)";
       
        $result=$this->setData($sqlQuery);
    
        return $result->execute()?true:false;
            
    }


    public function updatePropietarios(){
        $sqlQuery = "UPDATE  ".$this->table." 
        SET nombre=?,apellido=?,identificacion=?,
        fecha_nacimiento=?,direccion=?,
        telefono=?,email=? WHERE id=".$this->id."";

        $result=$this->setData($sqlQuery);    
        return $result->execute()?true:false;
          

    }

    public function deletePropietarios(){
        $sqlQuery = "DELETE FROM ".$this->table."  WHERE id=?";

            $result = $this->conn->prepare($sqlQuery);
       
            $this->id=htmlspecialchars(strip_tags($this->id));
           
            $result->bindParam(1, $this->id);

            return $result->execute()?true:false;
    }

}

?>