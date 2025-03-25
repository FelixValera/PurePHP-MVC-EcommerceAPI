<?php
namespace app\http\Middlewares;

class SessionStartMiddlewares extends Middleware{

    public function handler($request){

        session_start();
        
        $this->next($request);
    }
}

