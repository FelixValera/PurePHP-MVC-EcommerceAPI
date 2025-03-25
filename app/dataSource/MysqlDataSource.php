<?php
namespace app\dataSource;

use PDO;
use PDOException;

class MysqlDataSource implements IDataSource{

    private ?PDO $pdo=null;
    
    static public $instance=null;

    private function __construct(){
        
        $host='localhost';
        $db='phpAvanzado';
        $user='root';
        $pass='';

        try{
            $this->pdo= new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // Patron de diseño singleton de instancias garantiza que la clase solo tenga una instancia 
    static public function getInstance(){

        if(!isset(self::$instance)){

            self::$instance = new MysqlDataSource();
        }

        return self::$instance;
    }

    public function findAll($resource){

        $response=[];
        $sql="SELECT * FROM $resource";
        $datos = $this->pdo->query($sql);
        
        while($record = $datos->fetch(PDO::FETCH_ASSOC)){
            array_push($response,$record);
        }
        
        return $response;
    }

    public function findOne($resource,$field,$value){

        $sql="SELECT * FROM $resource WHERE $field = :value";
        $stmt=$this->pdo->prepare($sql);
        $stmt->bindValue(':value',$value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
        
    public function findMany($resource,$field,$operation,$value){

        $response=[];
        $sql="SELECT * FROM $resource WHERE $field $operation :value";
        $stmt= $this->pdo->prepare($sql);
        $stmt->bindValue(':value',$value);
        $stmt->execute();

        while($record= $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    public function create($resource,array $data){

        $fieldstring='';
        $valuestring='';

        foreach($data as $key => $value){

            $fieldstring.= "$key,";
            $valuestring.= ":$key,";
        }

        $fieldstring = rtrim($fieldstring,',');
        $valuestring = rtrim($valuestring,',');

        $sql= "INSERT INTO $resource ($fieldstring) VALUES ($valuestring)";

        $stmt= $this->pdo->prepare($sql);

        foreach($data as $key => $value){

            $stmt->bindValue(":$key",$value);
        }

        try{
            $stmt->execute();
        }
        catch(PDOException $e){

            echo $e->errorInfo;
            exit;
        }
    }

    public function update($resource,array $data,$field,$val){
        
        $fieldstring='';
        
        foreach($data as $key => $value){

            $fieldstring.= "$key=:$key,";
        }

        $fieldstring = rtrim($fieldstring,',');
        
        $sql= "UPDATE $resource SET $fieldstring WHERE $field = $val";
        
        $stmt= $this->pdo->prepare($sql);

        foreach($data as $key => $value){

            $stmt->bindValue(":$key",$value);
        }

        try{
            $stmt->execute();
        }
        catch(PDOException $e){

            echo $e->errorInfo;
            exit;
        }
    }

    public function delete($resource,$field,$value){

        $sql= "DELETE FROM $resource WHERE $field = :value";
        $stmt= $this->pdo->prepare($sql);
        $stmt->bindValue(":value",$value);
        try{
            $stmt->execute();
        }
        catch(PDOException $e){

            echo $e->errorInfo;
            exit;
        }
    }
}