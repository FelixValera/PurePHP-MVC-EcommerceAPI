<?php
namespace app\http\Routing;

class Router{

    //array donde guardamos todas las rutas
    private $_routes=[];

    public function add($method,$pattern,$callable){

        //sustituimos la '/' '\/' para pasarlo como expresion regular
        $pattern= str_replace('/','\/',$pattern);
        //guardamos un array por cada ruta
        array_push($this->_routes,
            [
                'method' => strtoupper($method),
                'pattern' => $pattern,
                'callable' => $callable
            ]
        );

        return $this;
    }

    public function get($pattern,$callable){

        $this->add('GET',$pattern,$callable);
        return $this;
    }

    public function post($pattern,$callable){

        $this->add('POST',$pattern,$callable);
        return $this;
    }

    public function put($pattern,$callable){

        $this->add('PUT',$pattern,$callable);
        return $this;
    }

    public function patch($pattern,$callable){

        $this->add('PATCH',$pattern,$callable);
        return $this;
    }

    public function delete($pattern,$callable){

        $this->add('DELETE',$pattern,$callable);
        return $this;
    }

    public function handler($request){

        foreach($this->_routes as $router){

            $pattern='#^'.$router['pattern'].'\/?$#';

            if(preg_match($pattern,$request->uri(),$urlParams) && $request->method()==$router['method']){
                
                array_shift($urlParams);
                
                return $router['callable']($request,$urlParams);
            }
        }
        
        echo "<body style = background:black>";
        echo "<h1 style = 'color:white; text-align:center;'>Error la pagina no existe :(</h1>";
        echo "</body>";
    }

}