<?php
namespace app\http\Routing;

use app\http\Middlewares\Middleware;

class RoutingMiddleware extends Middleware{

    public function __construct(
        private $_router
    ) {}

    public function router(){

        return $this->_router;
    }

    public function handler($request){

        return $this->router()->handler($request);
    }

}

