<?php
namespace core;

class Producto{

    public function __construct(

        public int $id=0,
        public string $nombre='',
        public int $id_categoria=0,
        public float $precio=0.0,
        public string $contenido='',
        public string $url_img_principal=''
    ){}

    public function toArray(){
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'id_categoria'=>$this->id_categoria,
            'precio'=>$this->precio,
            'contenido'=>$this->contenido,
            'url_img_principal'=>$this->url_img_principal
        ];
    }
}
