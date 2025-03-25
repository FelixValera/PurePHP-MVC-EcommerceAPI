<?php
namespace app\http\Middlewares;

class Middleware{

    private $_next;

    public function setNext($middleware){

        $this->_next=$middleware;
    }

    public function next($request){
        
        if(!is_null($this->_next)){
            $this->_next->handler($request);
        }
    }

    public function handler($request){}
    
}


