<?php
namespace app\http\Middlewares;

class ClosureMiddleware extends Middleware{
    
    public function __construct(
        private $_callable
    ) {}
    
    private function getCallable(){

        return $this->_callable;
    }

    public function handler($request){

        $callable= $this->getCallable();

        return $callable($request,$this);
    }
}



