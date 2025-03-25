<?php
namespace app\http;

class Request{

    public function __construct(
        private string $_uri='',
        private string $_method='GET',
        private array $_headers=[],
        private string $_body=''
    ) 
    {}

    public function uri(){
        return $this->_uri;
    }

    public function method(){
        return $this->_method;
    }

    public function headers(){
        return $this->_headers;
    }

    public function body(){
        return $this->_body;
    }

    public function uriStartWitch($search){

        return (substr($this->_uri,0,strlen($search)) === $search);
    }
    
    public function fromGlobal(){
        
        $this->_uri= $_SERVER['REQUEST_URI'];
        $this->_method= $_SERVER['REQUEST_METHOD'];
        $this->_headers= apache_request_headers();
        $this->_body= file_get_contents('php://input');

        return $this;
    }

    //El siguiente metodo nos sirve para trabajar con Request que no sean POST adjuntado archivos binarios
    public function ParseInput(){

        $input = $this->body();
        
        $data = false; //Para inicializar con un valor en caso que no tenga datos pasado datos 

        //Se ejecuta si el input es distinto a 44 caracteres (Boundary) y distinto a cero si no devuelve false
        if((strlen($input) != 44) && (strlen($input) != 0)){

            //Esta variable me indicara si en los parametros se enviaron por 'application/x-www-form-urlencoded' o 'multipart/form-data'
            $separador = substr($input,0,strpos($input,"\r\n"));
            
            if(empty($separador)){  //Los parametros son puro texto el conten-type:'application/x-www-form-urlencoded'
                
                parse_str($input,$response);
                return $response;
            }

            $arrayBody = explode($separador,$input);

            $arrayBody = array_slice($arrayBody,1);

            foreach($arrayBody as $valor){

                if($valor === "--\r\n"){
                    break;
                }
                
                $valor = ltrim($valor,"\r\n");
                //pasamos los elementos del array a variables
                list($header,$body) = explode("\r\n\r\n",$valor,2);   
                //pasamos ahora la variable a array
                $header = explode("\r\n",$header);
                
                $outputHeaders = [];

                foreach($header as $head){
                    
                    list($name,$value) = explode(':',$head);    //Pasamos los elementos a variables
                    $outputHeaders[strtolower($name)] = ltrim($value,' '); 
                }
                
                if(isset($outputHeaders['content-disposition'])){

                    $filename = null;
                    $tmp_name = null;

                    preg_match('#^(.+); *name="([^"]+)"(; *filename="([^"]+)")?#',$outputHeaders['content-disposition'],$matches);
                    
                    list(,$type,$name) = $matches;
                    
                    if(isset($matches[4])){  //Si existe un archivo binario

                        if(isset($_FILES[$matches[2]])){   //si ya existe el array Files sigue el Bucle
                            continue;
                        }

                        $filename = $matches[4];    //nombre del archivo 

                        $fileArray = pathinfo($filename);
                        //creamos un fichero temporal con nombre unico     
                        $tmp_name = tempnam(ini_get('upload_tmp_dir'),$fileArray['filename']); 
                        
                        $_FILES[$matches[2]] = [
                            'error' => 0,
                            'name' => $filename,
                            'tmp_name' => $tmp_name,
                            'size' => strlen($body),
                            'type' => $value 
                        ]; 

                        //Escribimos el contenido binario del archivo en el archivo temporal creado
                        file_put_contents($tmp_name,$body);
                    } 
                    else{
                        
                        $data[$name] = substr($body,0,strlen($body)-2);
                    }
                }
            }

            return $data;
        }
        else{
            
            return false;
        }

    }
}



