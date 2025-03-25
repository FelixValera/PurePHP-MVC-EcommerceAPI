<?php
namespace app\http;

use app\http\Middlewares\Middleware;

class RequestPipeline{

    private array $_handlers=[];

    public function use(Middleware $middleware){

        array_push($this->_handlers,$middleware);
    }

    public function handler(Request $request){
        
        //asignamos automaticamnete los handlers
        foreach($this->_handlers as $i=>$middleware){

            if(isset($this->_handlers[$i+1])){

                $middleware->setNext($this->_handlers[$i+1]);
            }
        }
        
        $this->_handlers[0]->handler($request);
    }

}

