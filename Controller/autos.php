<?php
require "autos_propietario.php";
class Autos extends Autos_Propietario{
   
    private $conn;
    private $table="tbl_auto";
    private $table_autos_detalle="tbl_vehiculo_propietario";
    public $placa;
    public $vin;
    public $linea;
    public $cilindrada;
    public $color;
    public $chasis;

    public function __construct($db){
        $this->conn = $db; 
       
    }

    public function obtenerDatos($sql_autos){

        $result=$this->conn->prepare($sql_autos);
        $result->execute();
        return $result;
    
       }

       public function obtenerId(){
        $query="SELECT max( id )+1 as id FROM ".$this->table."";
        $res_id=$this->conn->prepare($query);
        return $res_id; 
       }

    public function setData($sqlQuery){
        $result = $this->conn->prepare($sqlQuery);

        $this->placa=htmlspecialchars(strip_tags($this->placa));
        $this->vin=htmlspecialchars(strip_tags($this->vin));
        $this->linea=htmlspecialchars(strip_tags($this->linea));
        $this->cilindrada=htmlspecialchars(strip_tags($this->cilindrada));
        $this->color=htmlspecialchars(strip_tags($this->color));
        $this->chasis=htmlspecialchars(strip_tags($this->chasis));

        $this->id_propietario=htmlspecialchars(strip_tags($this->id_propietario));
        $this->id_auto=htmlspecialchars(strip_tags($this->id_auto));
        $this->id_marca=htmlspecialchars(strip_tags($this->id_marca));
        $this->id_tipo=htmlspecialchars(strip_tags($this->id_tipo));
        $this->id_modelo=htmlspecialchars(strip_tags($this->id_modelo));


        $result->bindParam(1,$this->placa);
        $result->bindParam(2, $this->vin);
        $result->bindParam(3, $this->linea);
        $result->bindParam(4, $this->cilindrada);
        $result->bindParam(5, $this->color);
        $result->bindParam(6, $this->chasis);

       
        return $result;
    }


    public function setAutos(){
        $sqlQuery = "INSERT INTO ".$this->table."(placa,vin,linea,cilindrada,
        color,chasis) VALUES(?,?,?,?,?,?)";
       

        $result=$this->setData($sqlQuery);
        $res=$this->obtenerId();
        
        if($res->execute()){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $this->id_auto=$row['id'];
            if($result->execute()){
                $query="INSERT INTO ".$this->table_autos_detalle."( id_modelo,id_tipo,id_marca,
                id_vehiculo,id_propietario) 
                VALUES(".$this->id_modelo.",".$this->id_tipo.",
                ".$this->id_marca.",".$this->id_auto.",
                ".$this->id_propietario.")";
                $result_final=$this->conn->prepare($query);
               
            }
        }
      

        return $result_final->execute()?true:false;
    
        
            
    }


    public function DataAuto(){
        $selectID="SELECT tad.id as id_detalle FROM ".$this->table." t 
        INNER JOIN ".$this->table_autos_detalle." tad 
        ON  tad.id_vehiculo=t.id  WHERE t.id =".$this->id."";
       $res_id=$this->conn->prepare($selectID);
       
       return $res_id;
    }
// ESTE TIPO DE QUERY LO ADECUADO ES USAR UN PROCEDIMIENTO ALMACENADO 
//DE LA FUNCION ACTUALIZar


    public function updateAutos(){
        $autoQuery = "UPDATE  ".$this->table." 
        SET placa=?,vin=?,linea=?,
        cilindrada=?,color=?,
        chasis=? WHERE id = '".$this->id."'";

        
        $result_auto=$this->setData($autoQuery);
        return $result_auto;
    }



    public function updateDetallesAutos(){
        //la siguiente query hace una union entre dos tablas para obtener el id de detalles

       
        $res=$this->DataAuto();
        
        if($res->execute()){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $id_detalle=$row['id_detalle'];
            
            $result_auto=$this->updateAutos();
            if($result_auto->execute()){
                $query="UPDATE  ".$this->table_autos_detalle." SET id_tipo= ".$this->id_tipo.",
                        id_modelo= ".$this->id_modelo.", 
                        id_marca= ".$this->id_marca.",  id_propietario= ".$this->id_propietario."
                        where id = $id_detalle";
                $result_final=$this->conn->prepare($query);
            }
        }
       
        return $result_final->execute()?true:false;
          

    }


    public function deleteAutos(){
            $sqlQuery ="DELETE FROM ".$this->table_autos_detalle." WHERE id_vehiculo=".$this->id."";
            $result = $this->conn->prepare($sqlQuery);

            if($result->execute()){
                $sql="DELETE FROM ".$this->table."  WHERE id=".$this->id;
                $res=$this->conn->prepare($sql);
                
            }
            return $res->execute()?true:false;
    }

}

?>