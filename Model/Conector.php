<?php
class Connector{
      
        public $hostname=DB_HOST;
        public $dbname=DB_NAME;
        public $user=DB_USER;
        public $password=DB_PASS;
        public $conn;
        public $error;
 

   public function getConectordb(){
       try {
        $this->conn=new PDO("pgsql:host=$this->hostname;dbname=$this->dbname",$this->user,$this->password);
        if(!$this->conn){
            echo "conexion fallida".$this->error;
        }
      
           //code...
       } catch (PDOException $exc) {
           echo "conexion dallida $exc";
       }
      
       return $this->conn;
   }

 
 
}


?>