<?php
namespace app\repositories;

use app\dataSource\IDataSource;
use core\Usuario;

class UsuarioRepository{

    public function __construct(
        private IDataSource $dataSource
    ) {}

    public function findAll(){

        $result= $this->dataSource->findAll('usuarios');
        $output=[];

        foreach($result as $field){

            $object = new Usuario(
                $field['id'],
                $field['email'],
                $field['password'],
                $field['api_key'],
                $field['rol']
            );
            
            array_push($output,$object);
        }

        return $output;
    }

    public function findById($id){

        $result = $this->dataSource->findOne('usuarios','id',$id);
        
        if(is_array($result)){

            $object = new Usuario(
                $result['id'],
                $result['email'],
                $result['password'],
                $result['api_key'],
                $result['rol']
            );

            return $object;
        }
        else{

            return 'ERROR: El registro no existe :(';
        }
    }

    public function find($field,$operation,$value){

        $result = $this->dataSource->findMany('usuarios',$field,$operation,$value);
        $output = [];
        
        if(!empty($result)){

            foreach($result as $data){

                $object = new Usuario(
                    $data['id'],
                    $data['email'],
                    $data['password'],
                    $data['api_key'],
                    $data['rol']
                );
                
                array_push($output,$object);
            }

            return $output;
        }
        else{

            return 'ERROR: No se encontraron resultados :(';
        }
    }

    public function create($usuario){

        $this->dataSource->create('usuarios',$usuario->toArray());
    }

    public function update($usuario){

        $this->dataSource->update('usuarios',$usuario->toArray(),'id',$usuario->id);
    }

    public function delete($usuario){

        $this->dataSource->delete('usuarios','id',$usuario->id);
    }

}