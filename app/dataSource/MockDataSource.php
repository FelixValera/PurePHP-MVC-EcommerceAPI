<?php
namespace app\dataSource;

class MockDataSource implements IDataSource{

    public array $data=[];

    public function __construct(array $categoria,array $producto){
        //inserta los array en data 

        array_push($this->data,$categoria,$producto);
    }

    public function findAll($resource){
        //optiene un array data

        return $this->data;

    }

    public function findOne($resource,$field,$value){

        if(($this->data[$resource][$field]) == $value ){

            return $this->data[$resource][$field];
        }
        else{

            echo 'No exite ese valor en el array';
        }
    }

    public function findMany($resource,$field,$operation,$value){
        //optiene todos los array de data 
        return $this->data;
    }

    public function create($resource,$data){
        //crea un nuevo elmento dentro del array $resource con el valor $data dado
        array_push($this->data[$resource],$data);

        ksort($this->data[$resource]);
    }

    public function update($resource,$data,$field,$value){
        //actualiza el valor y la llave del elemento indicado 

        //primero eliminamos el elemento que queremos actualizar
        unset($this->data[$resource][$data]);

        // ahora con el operador += le agregamos otro elemento al array
        $this->data[$resource] += ["$field"=>"$value"];

        //ordenamos el array nuevamente por indice 
        ksort($this->data[$resource]);
    }

    public function delete($resource,$field,$value){
        
        if((isset($this->data[$resource][$field]) && $this->data[$resource][$field] == $value)){

            unset($this->data[$resource][$field]);
        }
        else{
            echo ':( ERROR no se encontro el indice del array o el valor no coincide';
        }
    }
    
}