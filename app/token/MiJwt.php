<?php
namespace app\token;

use core\Usuario;

class MiJwt{

    private string $secretKey = 'clave_secreta_JWT';
    private string $regexJwt = '#^eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9\.[\w=+/]+\.[\w=+/]+$#';
    //Creamos el token 
    public function encode(Usuario $usuario){

        //codificamos el encabezado en base64
        $header = ['alg'=>'HS256', 'typ'=>'JWT'];
        $headerJson = json_encode($header);
        $headerEncode = base64_encode($headerJson);
        
        //codificamos el payload en base64
        $payload = ['id'=>$usuario->id,'email'=>$usuario->email,'rol'=>$usuario->rol];
        $payloadJson = json_encode($payload);
        $payloadEncode = base64_encode($payloadJson);
        
        //concatenamos las cadenas 
        $headerPayload = $headerEncode.'.'.$payloadEncode;

        //creamos la firma y generamos el token 
        $signature = base64_encode(hash_hmac('sha256',$headerPayload,$this->secretKey,true));
        $token = $headerPayload.'.'.$signature;
        
        return $token;
    }
    
    private function validate($token){
        
        if (preg_match($this->regexJwt,$token)){

            $receiveToken = $token;
            $tokenValue = explode('.',$receiveToken);
            $receiveSignature = $tokenValue[2];
            $headerPayload = $tokenValue[0].'.'.$tokenValue[1];

            $signature = base64_encode(hash_hmac('sha256',$headerPayload,$this->secretKey,true)); 

            if ($receiveSignature === $signature){

                return true;
            }
            else{

                return false;
            }
        }
        else{
            return false;
        }
    }
    //Si el token es valido devolvemos la informacion en un JSON
    public function decode($token){ 
        
        if($this->validate($token)){
            
            $tokenValue = explode('.',$token);
            $payload = json_decode(base64_decode($tokenValue[1]));
            
            return $payload;
        }
        else{
            //401 Unauthorized
            http_response_code(401);
        }
    }
    
}