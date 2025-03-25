<?php
namespace app\repositories;

use app\dataSource\IDataSource;
use core\Categoria;

class CategoriaRepository{

    public function __construct(
        private IDataSource $dataSource
    ) {}

    public function findAll(){

        $result= $this->dataSource->findAll('categoria');
        $output=[];

        foreach($result as $field){

            $object = new Categoria(
                $field['id'],
                $field['nombre'],
                $field['descripcion'],
                $field['url_imagen'],
            );
            
            array_push($output,$object);
        }

        return $output;
    }

    public function findById($id){

        $result = $this->dataSource->findOne('categoria','id',$id);
        
        if(is_array($result)){

            $object = new Categoria(
                $result['id'],
                $result['nombre'],
                $result['descripcion'],
                $result['url_imagen'],
            );

            return $object;
        }
        else{

            return 'ERROR: El registro no existe :(';
        }
    }

    public function find($field,$operation,$value){

        $result = $this->dataSource->findMany('categoria',$field,$operation,$value);
        $output = [];
        
        if(!empty($result)){

            foreach($result as $data){

                $object = new Categoria(
                    $data['id'],
                    $data['nombre'],
                    $data['descripcion'],
                    $data['url_imagen'],
                );
                
                array_push($output,$object);
            }

            return $output;
        }
        else{

            return 'ERROR: No se encontraron resultados :(';
        }
    }

    public function create($categoria){

        $this->dataSource->create('categoria',$categoria->toArray());
    }

    public function update($categoria){

        $this->dataSource->update('categoria',$categoria->toArray(),'id',$categoria->id);
    }

    public function delete($categoria){

        $this->dataSource->delete('categoria','id',$categoria->id);
    }

}