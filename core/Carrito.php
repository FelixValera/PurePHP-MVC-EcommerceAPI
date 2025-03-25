<?php
namespace core;

class Carrito{

    private array $items=[];

    public function __construct(?CarritoItem $articulo=null) 
    {   
        if(isset($articulo)){

            $this->items[] = $articulo;
        }

    }

    public function items(){
        
        return $this->items;
    }

    // La siguiente funcion devuelve un array con los valores del producto en el carrito 
    public function toArray(){

        $output = array_map(function($articulo){

            return[
                'cantidad' => $articulo->cantidad,
                'total' => $articulo->total,
                'producto' => [
                    'id' => $articulo->producto->id,
                    'nombre' => $articulo->producto->nombre,
                    'descripcion' => $articulo->producto->contenido,
                    'url_img_principal' => $articulo->producto->url_img_principal,
                    'precio' => $articulo->producto->precio
                ]
            ];

        },$this->items);

        return $output;
    }

    
    public function contiene(Producto $articulo){
        
        $response = false;

        foreach($this->items as $valor){

            if ($valor->producto->id == $articulo->id){
                $response = true;
                break;    
            }
        }

        return $response;
    }
    
    public function agregar(Producto $articulo,$cantidad=1){

        array_push($this->items,(new CarritoItem($articulo,$cantidad)));
    }

    
    public function quitar(Producto $articulo){

        $this->items = array_filter($this->items, function($n) use ($articulo){
                
            return $n->producto->id != $articulo->id;
        });

        sort($this->items);
    }

    public function incrementar(Producto $articulo){

        array_map(function($n) use ($articulo){

            if($n->producto->id == $articulo->id){

                $n->incrementar(); 
            }

        },$this->items);
    }

    public function reducir(Producto $articulo){

        array_map(function($n) use ($articulo){

            if($n->producto->id == $articulo->id){

                $n->reducir(); 
            }

        },$this->items);
    }

}

