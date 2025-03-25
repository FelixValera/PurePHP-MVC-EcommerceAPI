<?php
namespace app\http\Middlewares;

use app\token\MIJwt;
use Exception;

class AuthoMiddleware extends Middleware{

    public function handler($request){

        $headers = $request->headers();
        
        if(isset($headers['authorization']) && !empty($headers['authorization'])){
            
            $token = explode(' ',$headers['authorization']);
        
            $mijwt = new MIJwt();

            $response = isset($token[1]) ? $mijwt->decode($token[1]) : false;

            if($response){

                $request->payload = $response;
                $this->next($request);
            }
            else{
                http_response_code(404);
            }
        }
        else{

            http_response_code(404);
        }
    }
}