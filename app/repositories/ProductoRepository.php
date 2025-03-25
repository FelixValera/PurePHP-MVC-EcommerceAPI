<?php
namespace app\repositories;

use app\dataSource\IDataSource;
use core\Producto;

class ProductoRepository{

    public function __construct(
        private IDataSource $dataSource
    ) {}

    public function findAll(){

        $result = $this->dataSource->findAll('productos');
        $output = [];

        foreach($result as $dato){
            
            $object = new Producto(
                $dato['id'],
                $dato['nombre'],
                $dato['id_categoria'],
                $dato['precio'],
                $dato['contenido'],
                $dato['url_img_principal']
            );

            array_push($output,$object);
        }

        return $output;
    }

    public function findById($id){

        $result = $this->dataSource->findOne('productos','id',$id);

        if(is_array($result)){

            $object = new Producto(
                $result['id'],
                $result['nombre'],
                $result['id_categoria'],
                $result['precio'],
                $result['contenido'],
                $result['url_img_principal']
            ); 
            return $object;
        }
        else{
            return 'ERROR: El registro no existe :(';
        }
    }

    public function find($field,$operation,$value){

        $result = $this->dataSource->findMany('productos',$field,$operation,$value);
        $output = [];

        if(!empty($result)){

            foreach($result as $dato){
            
                $object = new Producto(
                    $dato['id'],
                    $dato['nombre'],
                    $dato['id_categoria'],
                    $dato['precio'],
                    $dato['contenido'],
                    $dato['url_img_principal']
                );
    
                array_push($output,$object);
            }
    
            return $output;
        }
        else{
            return 'ERROR: No se encontraron resultados :(';
        }
    }

    public function create($producto){

        $this->dataSource->create('productos',$producto->toArray());
    }

    public function update($producto){

        $this->dataSource->update('productos',$producto->toArray(),'id',$producto->id);
    }

    public function delete($producto){

        $this->dataSource->delete('productos','id',$producto->id);
    }
}