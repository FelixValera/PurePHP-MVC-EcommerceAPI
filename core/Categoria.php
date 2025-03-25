<?php
namespace core;

class Categoria{

    public function __construct(

        public int $id=0,
        public string $nombre='',
        public string $descripcion='',
        public string $url_imagen='',
    ) {}

    public function toArray(){
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'url_imagen' => $this->url_imagen,
        ];
    }
}

