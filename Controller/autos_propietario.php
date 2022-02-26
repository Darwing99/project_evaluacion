<?php

class Autos_Propietario{
   
    private $conn;
    public $id;
    private $table="tbl_auto_propietario";
    public $id_auto;
    public $id_propietario;
    public $id_modelo;
    public $id_marca;
    public $id_tipo;
    public $nombre;
    public $marca;
    

    public function __construct($db){
        $this->conn = $db;
       
    }

    public function obtenerDatos($sqlTipo){

        $result=$this->conn->prepare($sqlTipo);
        $result->execute();
        return $result;
    
       }


       //Funcion para generar Datos desde 
       public function obtenerDetallesAuto(){
            $consulta=$this->nombre;
            if(!empty($consulta)){
                $query="SELECT tp.nombre  AS nombre ,ta.placa AS placa, ta.color AS color, tm.marca AS marca 
                FROM tbl_vehiculo_propietario tvp 
                INNER JOIN tbl_auto ta ON ta.id =tvp.id_vehiculo  
                INNER JOIN tbl_marca tm ON tvp.id_marca =tm.id
                INNER JOIN tbl_propietario tp ON tp.id=tvp.id_propietario  
                WHERE LOWER(tp.nombre) LIKE '%".strtolower($this->nombre)."%' ORDER BY ta.placa ASC"; 
            }else{
                $query="SELECT tp.nombre  AS nombre ,ta.placa AS placa, ta.color AS color, tm.marca AS marca 
                FROM tbl_vehiculo_propietario tvp 
                INNER JOIN tbl_auto ta ON ta.id =tvp.id_vehiculo  
                INNER JOIN tbl_marca tm ON tvp.id_marca =tm.id
                INNER JOIN tbl_propietario tp ON tp.id=tvp.id_propietario  
                ORDER BY ta.placa ASC";
            }
            


            $result=$this->conn->prepare($query);  
           
            $result->execute();
            return $result;
       
        
       }




}


?>