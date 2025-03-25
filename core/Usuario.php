<?php
namespace core;

class Usuario{

    public function __construct(

        public int $id=0,
        public string $email='',
        public string $password='',
        public string $api_Key='',
        public string $rol='read'   //superAdmin, admin, read (default)
    
    ) {}

    public function toArray(){
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'api_Key' => $this->api_Key,
            'rol' => $this->rol
        ];
    }
}

