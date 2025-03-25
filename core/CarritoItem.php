<?php 
namespace core;

class CarritoItem{

    public function __construct(
        
        public Producto $producto,
        public int $cantidad=1,
        public float $total = 0.0
    ) 
    {
        
        $this->total = $this->producto->precio;
    }

    public function incrementar(){

        $this->cantidad = $this->cantidad + 1;
        $this->total = $this->producto->precio * $this->cantidad;
    }

    public function reducir(){
        
        if($this->cantidad != 1){
            $this->cantidad = $this->cantidad - 1;
            $this->total = $this->producto->precio * $this->cantidad;
        }
    }
}


