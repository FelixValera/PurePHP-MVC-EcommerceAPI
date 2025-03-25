<?php

namespace app\http;

use app\http\Middlewares\ClosureMiddleware;
use app\http\Routing\Router;
use app\http\Routing\RoutingMiddleware;

class Server{

    private $_router;
    private $_pipeline;
    private $_request;

    public function __construct(Request $request){
        
        $this->_router = new Router();
        $this->_pipeline = new RequestPipeline();
        $this->_request = $request;
    }

    public function router(){

        return $this->_router;
    }

    public function if($url,$configCallback){  //Si es una API se agregan determinadas rutas 

        if($this->_request->uriStartWitch($url)){
            $configCallback($this);
        }
    }

    public function not($url,$configCallback){

        if(!$this->_request->uriStartWitch($url)){
            $configCallback($this);
        }
    }

    public function use($middleware){

        if(is_callable($middleware)){

            $this->_pipeline->use(new ClosureMiddleware($middleware));
        }
        else{

            $this->_pipeline->use($middleware);
        }
    }

    public function handler(){

        $this->use(new RoutingMiddleware($this->_router));

        $this->_pipeline->handler($this->_request);
    }
}