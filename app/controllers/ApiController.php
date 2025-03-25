<?php
namespace app\controllers;

use app\repositories\CategoriaRepository;
use app\repositories\ProductoRepository;
use app\repositories\UsuarioRepository;
use app\dataSource\MysqlDataSource;
use core\Producto;
use core\Categoria;
use app\token\MiJwt;
use app\mail\Mail;



class ApiController{
    
    private static $source; 
    
    private static function GetSource(){

        self::$source = MysqlDataSource::getInstance();
    }

    //verifica si una categoria existe 
    private static function CategoriaExis($id_categoria){   

        self::GetSource();  
        
        $db = new CategoriaRepository(self::$source);
        
        $categoria = $db->find('id','=',$id_categoria);

        if(is_array($categoria)){

            return true;
        }
        else{
            return false;
        }
    }

    //El siguiente metodo realiza el proceso de subir la imagen
    private static function Upload($file,$id_categoria=0,$oldRoute=''){  
        $imagen = sha1_file($file['tmp_name']);
        $tmp_name = $file['tmp_name'];

        self::GetSource();  
        
        $db = new CategoriaRepository(self::$source);
        //Creamos un array con las rutas de las carpetas por medio de los registros de la tabla categoria y las Key del array seran el id de las categorias  
        $array = $db->findAll();   
        $dir = [];
        
        foreach($array as $valor){

            $response = substr($valor->url_imagen,0, strpos($valor->url_imagen,"/",5));
            $dir[$valor->id] = $response;
        }

        if(getimagesize($tmp_name)){  //verificamos si es una imagen

            if(!empty($oldRoute) && file_exists($_SERVER['DOCUMENT_ROOT'].$oldRoute)){  //Si el archivo existe y el parametro oldRoute esta definido se ejecuta

                unlink($_SERVER['DOCUMENT_ROOT'].$oldRoute);   
            }

            if(array_key_exists($id_categoria,$dir)){   //Si la categoria existe

                $ruta = $_SERVER['DOCUMENT_ROOT'].$dir[$id_categoria].'/'.$imagen;
                
                if(is_uploaded_file($tmp_name)){    //Si el archivo fue subido usando el methodo POST

                    move_uploaded_file($tmp_name,$ruta);
                }
                else{

                    rename($tmp_name,$ruta);    //movemos el archivo a donde corresponde
                }
                
                return $dir[$id_categoria].'/'.$imagen;
            }
            else{

                return false;
            }
        }
        else{

            return false;
        }
        
    }

    //--------------------------------- API PRODUCTOS----------------------------------------------
    public static function AllProducto($req,$param){
        
        $db = new ProductoRepository($req->datasource);
        $response = $db->findAll();

        header('Content-type: application/json');
        echo json_encode($response);
    }

    public static function OneProducto($req,$param){
        
        header('Content-type: application/json');
        $db = new ProductoRepository($req->datasource);
        
        if (is_object($response = $db->findById($param[0]))){

            echo json_encode($response);
        }
        else{
            http_response_code(400);
            echo json_encode(['ERROR'=>'No existe el registro :-(']);
        }
    }

    public static function CreateProducto($req,$param){
        
        header('Content-type: application/json');
        $inputPatron = (new Producto())->toArray();
        $inputCant = count($inputPatron);
        
        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            // evaluamos si los parametros pasados son los correctos 
            if(!empty($_POST) && !empty($_FILES['file']['tmp_name'])){     
               
                foreach($_POST as $key=>$valor){
    
                    if(array_key_exists($key,$inputPatron)){
                        
                        $input[$key] = trim($_POST[$key]);
                    }
                    else{
                        
                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                        exit;
                    }
                }
                
                $input['id'] = 0;
                $input['url_img_principal'] = '';

                if(count($input) === $inputCant){   //chequeamos si esta el total de los parametros necesarios
    
                    extract($input);
                    //pasamos los variabes de tipo string a su tipo correspondiente
                    $id = (int)$id;
                    $id_categoria = (int)$id_categoria;
                    $precio = (float)$precio;

                    //comprobamos el tipo de los parametros y los valores
                    if ((!is_string($nombre) || empty($nombre)) || (!is_int($id_categoria) || empty($id_categoria)) || (!is_float($precio) || empty($precio)) || (!is_string($contenido) || empty($contenido))){
                        
                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                    }
                    else{

                        $ruta = self::Upload($_FILES['file'],$id_categoria);    //Subimos la imagen

                        if($ruta){

                            $url_img_principal = $ruta;

                            $producto = new Producto($id,$nombre,$id_categoria,$precio,$contenido,$url_img_principal);

                            $db = new ProductoRepository($req->datasource);

                            $db->create($producto);

                            http_response_code(200);
                            echo json_encode(['BIEN'=>'Producto registrado con exito !!! :-)']);
                        }
                        else{

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                        }
                    }
                }
                else{
    
                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                }
            }
            else{
    
                http_response_code(400);
                echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function UpdateProducto($req,$param){
       
        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){   //verificamos que sea administrador

            $db = new ProductoRepository($req->datasource);

            $producto = $db->findById($param[0]);

            if(is_object($producto)){   //verificamos que el producto exista

                $_PUT = $req->ParseInput();

                if($_PUT && !empty($_FILES['file']['tmp_name'])){   //verificamos si mando los parametros necesarios 

                    $inputPatron = $producto->toArray();
                    $inputCant = count($inputPatron);
                    
                    foreach($_PUT as $key=>$valor){
    
                        if(array_key_exists($key,$inputPatron)){
                            
                            $input[$key] = trim($_PUT[$key]);
                        }
                        else{
                            
                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                            exit;
                        }
                    }

                    $input['id'] = $producto->id;
                    $input['url_img_principal'] = '';
                    
                    if(count($input) === $inputCant){

                        extract($input);
                        //pasamos los variabes de tipo string a su tipo correspondiente
                        $id = (int)$id;
                        $id_categoria = (int)$id_categoria;
                        $precio = (float)$precio;
                        
                        //comprobamos el tipo de los parametros y los valores
                        if ((!is_string($nombre) || empty($nombre)) || (!is_int($id_categoria) || empty($id_categoria)) || (!is_float($precio) || empty($precio)) || (!is_string($contenido) || empty($contenido))){
                            
                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                        }
                        else{
                            
                            $ruta = self::Upload($_FILES['file'],$id_categoria,$producto->url_img_principal);   //Subimos la imagen
                            
                            if($ruta){

                                $input['url_img_principal'] = $ruta;

                                foreach($input as $propiedad => $valor){    //Cargamos los nuevos valores al producto

                                    $producto->$propiedad = $valor;
                                }

                                $db->update($producto);
    
                                http_response_code(200);
                                echo json_encode(['BIEN'=>'Producto actualizado con exito !!! :-)']);
                            }
                            else{
    
                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                            }
                        }   
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                    }

                }
                else{
                
                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
                }
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'El producto no existe :-(']);
            }
        
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function PatchProducto($req,$param){  //Metodo para realizar un cambio parcial
        
        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            $db = new ProductoRepository($req->datasource);

            $producto = $db->findById($param[0]);

            if(is_object($producto)){

                $_PATCH = $req->ParseInput();
                
                if($_PATCH || $_FILES['file']){

                    $inputPatron = $producto->toArray();
                    $inputCant = count($inputPatron);
                    
                    if(!empty($_PATCH)){ //si no esta vacia se ejecuta 
                        
                        foreach($_PATCH as $key=>$valor){
    
                            if(array_key_exists($key,$inputPatron)){
                                
                                $input[$key] = trim($_PATCH[$key]);
                            }
                            else{
                                
                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                                exit;
                            }
                        }
                    }
                   
                    $input['id'] = $producto->id;

                    if((count($input) >= 1 && count($input) <= $inputCant)){

                        foreach($input as $key => $valor){  //Cambiamos el tipo de los datos de entrada

                            if($key === 'id' || $key === 'id_categoria'){

                                $input[$key] = (int)$valor;
                            }

                            if($key === 'precio'){

                                $input[$key] = (float)$valor;
                            }
                        }

                        foreach($input as $key => $valor){  //Verificamos el tipo de dato y sus valores
                            
                            if(is_string($valor) && !empty($valor)){

                                continue;
                            }
                            elseif((is_int($valor) || is_float($valor)) && !empty($valor)){ 

                                if($key === 'id_categoria' && !self::CategoriaExis($valor)){

                                    http_response_code(400);
                                    echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                                    exit;
                                }
                                
                                continue;
                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                                exit; 
                            }
                        }

                        if(isset($_FILES['file'])){     //Si suben un archivo binario

                            if(!array_key_exists('id_categoria',$input)){   //Si el usuario no manda el id_categoria 
                                
                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Debes especificar \'id_categoria\' para subir imagenes :-(']);
                                exit;
                            }

                            $ruta = self::Upload($_FILES['file'],$input['id_categoria'],$producto->url_img_principal);

                            if($ruta){

                                $input['url_img_principal'] = $ruta;

                                foreach($input as $propiedad => $valor){    //Cargamos los nuevos valores al producto

                                    $producto->$propiedad = $valor;
                                }

                                $db->update($producto);
    
                                http_response_code(200);
                                echo json_encode(['BIEN'=>'Producto parcialmente actualizado con exito !!! :-)']);

                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                            }
                        }
                        else{

                            $input['url_img_principal'] = $producto->url_img_principal;

                            foreach($input as $propiedad => $valor){

                                $producto->$propiedad = $valor;
                            }
                            
                            $db->update($producto);

                            http_response_code(200);
                            echo json_encode(['BIEN'=>'Producto parcialmente actualizado con exito !!! :-)']);
                        }
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                    }
                }
                else{
                    
                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
                }
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'El producto no existe :-(']);
            }

        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    
    }

    public static function DeleteProducto($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            $db = new ProductoRepository($req->datasource);

            $producto = $db->findById($param[0]);

            if(is_object($producto)){

                //Si el producto tiene la ruta de una imagen y la imagen existe se elimina
                if(!empty($producto->url_img_principal) && file_exists($_SERVER['DOCUMENT_ROOT'].$producto->url_img_principal)){

                    unlink($_SERVER['DOCUMENT_ROOT'].$producto->url_img_principal);
                }
               
                $db->delete($producto);
                
                http_response_code(200);
                echo json_encode(['BIEN'=>'Producto eliminado con exito !!! :-)']);
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'El producto no existe :-(']); 
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }


    //----------------------------------------API CATEGORIA--------------------------------------------------------

    public static function AllCategoria($req,$param){

        $db = new CategoriaRepository($req->datasource);
        $response = $db->findAll();

        header('Content-type: application/json');
        echo json_encode($response);
    }

    public static function OneCategoria($req,$param){

        header('Content-type: application/json');
        $db = new CategoriaRepository($req->datasource);

        if(is_object($response = $db->findById($param[0]))){

            echo json_encode($response);
        }
        else{

            http_response_code(400);
            echo json_encode(['ERROR'=>'No existe el registro :-(']);
        }
    }

    public static function CreateCategoria($req,$param){

        header('Content-type: application/json');
        $inputPatron = (new Categoria())->toArray();
        $inputCant = count($inputPatron);
        
        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            if(!empty($_POST) && !empty($_FILES['file']['tmp_name'])){     // evaluamos si los parametros pasados son los correctos 
               
                foreach($_POST as $key=>$valor){
    
                    if(array_key_exists($key,$inputPatron)){
                        
                        $input[$key] = trim(ucfirst($_POST[$key]));
                    }
                    else{
                        
                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                        exit;
                    }
                }
                
                $input['id'] = 0;
                $input['url_imagen'] = '';

                if(count($input) === $inputCant){   //chequeamos si esta el total de los parametros necesarios
    
                    extract($input);
                    //pasamos los variabes de tipo string a su tipo correspondiente
                    $id = (int)$id;

                    //comprobamos el tipo de los parametros y sus valores
                    if ((!is_string($nombre) || empty($nombre)) || (!is_string($descripcion) || empty($descripcion))){
                        
                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                    }
                    else{

                        $db = new CategoriaRepository($req->datasource);

                        $response = $db->find('nombre','=',$nombre);
                        //Comprobamos si la categoria ya existe 
                        if(is_array($response)){

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'La categoria ya existe :-(']);
                            exit;
                        }
                        
                        //creamos la carpeta de la categoria
                        if(!mkdir($_SERVER['DOCUMENT_ROOT']."/img/$nombre")){

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'No se pudo crear la carpeta :-(']);
                            exit;
                        }
                        
                        $url_imagen="/img/$nombre/";     //Le definimos la ruta de la carpeta

                        $categoria = new categoria($id,$nombre,$descripcion,$url_imagen);

                        $db->create($categoria);
                        
                        $arrayCategoria = $db->find('nombre','=',$nombre);

                        $ruta = self::Upload($_FILES['file'],$arrayCategoria[0]->id);

                        if($ruta){

                            $arrayCategoria[0]->url_imagen = $ruta;
                            
                            $db->update($arrayCategoria[0]);
                            
                            http_response_code(200);
                            echo json_encode(['BIEN'=>'Categoria creada con exito !!! :-)']);
                        }
                        else{

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                        }
                    }
                }
                else{
    
                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                }
            }
            else{
    
                http_response_code(400);
                echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function UpdateCategoria($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            $db = new CategoriaRepository($req->datasource);

            $categoria = $db->findById($param[0]);

            if(is_object($categoria)){

                $_PUT = $req->ParseInput();

                if($_PUT && !empty($_FILES['file']['tmp_name'])){
                    
                    $inputPatron = $categoria->toArray();
                    $inputCant = count($inputPatron);
                    
                    foreach($_PUT as $key=>$valor){
    
                        if(array_key_exists($key,$inputPatron)){
                            
                            $input[$key] = trim(ucfirst($_PUT[$key]));
                        }
                        else{
                            
                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                            exit;
                        }
                    }
                    
                    $input['id'] = $categoria->id;
                    $input['url_imagen'] = $categoria->url_imagen;

                    if((count($input) === $inputCant)){
                        
                        extract($input);
                        
                        if((!is_string($nombre) || empty($nombre)) || (!is_string($descripcion) || empty($descripcion))){
                        
                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                        }
                        else{

                            self::Upload($_FILES['file'],0,$categoria->url_imagen);  //eliminamos la imagen vieja
                             
                            $path = substr($categoria->url_imagen,0,strpos($categoria->url_imagen,"/",5));

                            $newPath = "/img/$nombre";

                            if(is_dir($_SERVER['DOCUMENT_ROOT'].$path)){   //cambiamos el nombre de la carpeta
                                
                                if(rename($_SERVER['DOCUMENT_ROOT'].$path, $_SERVER['DOCUMENT_ROOT'].$newPath)){} 
                                else{

                                    http_response_code(400);
                                    echo json_encode(['ERROR'=>'Error al renombrar la carpeta :-(']);
                                    exit;
                                }
                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'La carpeta antigua no existe :-(']);
                                exit;
                            }
                            
                            $dbP = new ProductoRepository($req->datasource);    //actualizamos la 'url_img_principal' de los productos

                            $productos = $dbP->find('id_categoria','=',$categoria->id);
                            
                            //Si la categoria tiene productos asociados 
                            if(is_array($productos)){

                                foreach($productos as $articulo){   

                                    $nombreImg = substr($articulo->url_img_principal,strpos($categoria->url_imagen,"/",5));
    
                                    $nombreImg = ltrim($nombreImg,'/');
    
                                    $articulo->url_img_principal = $newPath.'/'.$nombreImg;
    
                                    $dbP->update($articulo);
                                }
                            }
                            
                            foreach($input as $propiedad => $valor){    //actualizamos la database de categoria

                                $categoria->$propiedad = $valor;
                            }
                            $categoria->url_imagen = "/img/$nombre/";
                            $db->update($categoria);

                            $ruta = self::Upload($_FILES['file'],$categoria->id);   //subimos la imagen

                            if($ruta){  //actualizamos nuevamente la categoria con la nueva ruta

                                $categoria->url_imagen = $ruta;

                                $db->update($categoria);
    
                                http_response_code(200);
                                echo json_encode(['BIEN'=>'Categoria actualizada con exito !!! :-)']);
                            }
                            else{
    
                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                            }
                        }
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                    }
                
                }
                else{

                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
                }
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'La categoria no existe :-(']);
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function PatchCategoria($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            $db = new CategoriaRepository($req->datasource);

            $categoria = $db->findById($param[0]);

            if(is_object($categoria)){

                $_PATCH = $req->ParseInput();

                if($_PATCH || $_FILES['file']){

                    $inputPatron = $categoria->toArray();
                    $inputCant = count($inputPatron);

                    if(!empty($_PATCH)){ //si no esta vacia se ejecuta 

                        foreach($_PATCH as $key=>$valor){
    
                            if(array_key_exists($key,$inputPatron)){
                                
                                $input[$key] = trim(ucfirst($_PATCH[$key]));
                            }
                            else{
                                
                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                                exit;
                            }
                        }
                    }
                    
                    $input['id'] = $categoria->id;
                    $input['url_imagen'] = $categoria->url_imagen;

                    if((count($input) >= 1 && count($input) <= $inputCant)){
                        
                        foreach($input as $key => $valor){  //Verificamos el tipo de dato y sus valores
                            
                            if((is_string($valor) && !empty($valor)) || (is_int($valor) && $key === 'id')){

                                continue;
                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                                exit; 
                            }
                        }

                        extract($input);

                        if(isset($nombre)){     //Si cambia el nombre

                            $path = substr($categoria->url_imagen,0,strpos($categoria->url_imagen,"/",5));      //Cambiamos el nombre de la carpeta

                            $newPath = "/img/$nombre";

                            if(is_dir($_SERVER['DOCUMENT_ROOT'].$path)){   
                                
                                if(rename($_SERVER['DOCUMENT_ROOT'].$path, $_SERVER['DOCUMENT_ROOT'].$newPath)){} 
                                else{

                                    http_response_code(400);
                                    echo json_encode(['ERROR'=>'Error al renombrar la carpeta :-(']);
                                    exit;
                                }
                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'La carpeta antigua no existe :-(']);
                                exit;
                            }

                            
                            $dbP = new ProductoRepository($req->datasource);    //actualizamos la 'url_img_principal' de los productos

                            $productos = $dbP->find('id_categoria','=',$categoria->id);

                            //Si la categoria cuenta con productos asociados 
                            if(is_array($productos)){ 

                                foreach($productos as $articulo){   

                                    $nombreImg = substr($articulo->url_img_principal,strpos($categoria->url_imagen,"/",5));
    
                                    $nombreImg = ltrim($nombreImg,'/');
    
                                    $articulo->url_img_principal = $newPath.'/'.$nombreImg;
    
                                    $dbP->update($articulo);
                                }
                            }
                            
                            $imgCategoria = substr($categoria->url_imagen,strpos($categoria->url_imagen,"/",5));    //actualizamos los datos de la categoria

                            $imgCategoria = ltrim($imgCategoria,'/');

                            $categoria->url_imagen = $newPath.'/'.$imgCategoria;
                            
                            $categoria->nombre = $nombre;

                            $db->update($categoria);

                        }
                        if(!empty($_FILES['file']['tmp_name'])){    //Si sube una imagen
                            
                            $categoria = $db->findById($param[0]);

                            $ruta = self::Upload($_FILES['file'],$categoria->id,$categoria->url_imagen);
                            
                            if($ruta){

                                $categoria->url_imagen = $ruta;

                                $db->update($categoria);
                            }
                            else{

                                http_response_code(400);
                                echo json_encode(['ERROR'=>'Ocurrio un error al subir el archivo :-(']);
                                exit;
                            }
                        }
                        if(isset($descripcion)){    //Si cambia la descripcion

                            $categoria = $db->findById($param[0]);

                            $categoria->descripcion = $descripcion;

                            $db->update($categoria);
                        }
                        
                        http_response_code(200);
                        echo json_encode(['BIEN'=>'Categoria parcialmente actualizada con exito !!! :-)']);
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                    }
                
                }
                else{

                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Parametros no definidos :-(']);
                }
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'La categoria no existe :-(']);
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function DeleteCategoria($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'admin' || $req->payload->rol === 'superAdmin'){

            $db = new CategoriaRepository($req->datasource);

            $categoria = $db->findById($param[0]);

            if(is_object($categoria)){

                $path = substr($categoria->url_imagen,0,strpos($categoria->url_imagen,"/",5));

                if(is_dir($_SERVER['DOCUMENT_ROOT'].$path)){

                    $archivos = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].$path),['.','..']);

                    sort($archivos);

                    $imgCategoria = ltrim(substr($categoria->url_imagen,strpos($categoria->url_imagen,'/',5)),'/');
                    
                    if((count($archivos) === 1) && ($archivos[0] === $imgCategoria)){

                        unlink($_SERVER['DOCUMENT_ROOT'].$categoria->url_imagen); 

                        if(rmdir($_SERVER['DOCUMENT_ROOT'].$path)){

                            $db->delete($categoria);
                            
                            http_response_code(200);
                            echo json_encode(['BIEN'=>'Categoria eliminada con exito !!! :-)']);
                        }
                        else{

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'No se pudo eliminar la categoria :-(']);
                        } 
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'La categoria no esta vacia :-(']);
                    }
                    
                }
                else{

                    http_response_code(400);
                    echo json_encode(['ERROR'=>'La carpeta de la categoria no existe :-(']);
                }
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'La categoria no existe :-(']); 
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }
    
    //--------------------------------------API Users--------------------------------------------------------
    // Tiene que ser Super Admin
    
    public static function AllUsuario($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'superAdmin'){
            
            $db = new UsuarioRepository($req->datasource);
            $response = $db->findAll();

            echo json_encode($response);
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function OneUsuario($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'superAdmin'){

            $db = new UsuarioRepository($req->datasource);
        
            if (is_object($response = $db->findById($param[0]))){

                echo json_encode($response);
            }
            else{
                http_response_code(400);
                echo json_encode(['ERROR'=>'No existe el registro :-(']);
            }
        }
        else{
            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function PatchUsuario($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'superAdmin'){

            $db = new UsuarioRepository($req->datasource);

            $usuario = $db->findById($param[0]);

            if(is_object($usuario)){

                $_PATCH = $req->ParseInput();
                
                $inputPatron = $usuario->toArray();
                $inputCant = count($inputPatron);
                
                foreach($_PATCH as $key=>$valor){
    
                    if(array_key_exists($key,$inputPatron)){
                        
                        $input[$key] = trim($_PATCH[$key]);
                    }
                    else{
                        
                        http_response_code(400);
                        echo json_encode(['ERROR'=>'Los parametros son incorrectos :-(']);
                        exit;
                    }
                }

                $input['id'] = $usuario->id;
                $input['api_Key'] = $usuario->api_Key;
                
                if((count($input) >= 1 && count($input) <= $inputCant)){
                        
                    foreach($input as $key => $valor){  //Verificamos el tipo de dato y sus valores
                        
                        if((is_string($valor) && !empty($valor)) || (is_int($valor) && $key === 'id')){

                            continue;
                        }
                        else{

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Incorrecto tipos de parametros :-(']);
                            exit; 
                        }
                    }

                    extract($input);

                    //Creo el cuerpo del mail para su notificacion 
                    $body = "<p><b>Actualizacion de datos</b> Le informamos que se registraron cambios en sus datos de Usuario  !!! </p><br>";
                    
                    $flag = false; //para saber si se realizo algun cambio 

                    if(isset($email)){  //si cambia el mail

                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //validamos email

                            $usuario->email = $email;

                            $body.= "<p>Su Mail a cambiado<b> Mail: </b>$email</p><br>";
                            $flag = true;
                        }
                        else{

                            http_response_code(400);
                            echo json_encode(['ERROR'=>'Email incorrecto :-(']);
                            exit;   
                        }
                    }
                    if(isset($password)){   //si cambia el password
                        
                        $password = password_hash($password,PASSWORD_DEFAULT);
                        $usuario->password = $password;

                        $body.= "<p>Su contraseña a cambiado<b> Pass: </b>$password</p><br>";
                        $flag = true;
                    }
                    if(isset($rol)){       //si cambias el rol

                        $roles = ['read','admin','superAdmin'];

                        if(in_array($rol,$roles)){  

                            $usuario->rol = $rol;
                            
                            $miJwt = new MiJwt();
                            $token = $miJwt->encode($usuario);
                            $usuario->api_Key = $token;

                            $body.= "<p>Su rol a cambiado <b> Rol: </b>$usuario->rol<br> Este es su nuevo<b> Token: </b>$token</p><br>";
                            $flag = true;
                        }
                        else{
                            
                            http_response_code(400);
                            echo json_encode(['ERROR'=>'El tipo de rol no existe :-(']);
                            exit;
                        }
                    }
                    
                    if($flag){ //se realizaron cambios 

                        $body.= "<p>Si usted no realizo ningun cambio comunicarse con soporte</p>";
                    
                        $db->update($usuario);

                        //Se manda un correo al usuario con la informacion de los cambios en su cuenta 
                        $mail = new Mail('Showroom@example.com',$usuario->email,'Usuario Actualizacion de datos',$body);
                    
                        $req->mailer->enviar($mail);
                    
                        http_response_code(200);
                        echo json_encode(['BIEN'=>'Usuario parcialmente actualizado con exito !!! :-) se envio un mail con los cambios']);
                    }
                    else{

                        http_response_code(400);
                        echo json_encode(['ERROR'=>'No se realizaron ninguno de los cambios previstos :-(']);
                    }
                }
                else{

                    http_response_code(400);
                    echo json_encode(['ERROR'=>'Cantidad de parámetros incorrecta :-(']);
                }
            }
            else{
                http_response_code(400);
                echo json_encode(['ERROR'=>'No existe el registro :-(']);
            }
        }
        else{
            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

    public static function DeleteUsuario($req,$param){

        header('Content-type: application/json');

        if($req->payload->rol === 'superAdmin'){

            $db = new UsuarioRepository($req->datasource);

            $usuario = $db->findById($param[0]);

            if(is_object($usuario)){

                $db->delete($usuario);
                
                http_response_code(200);
                echo json_encode(['BIEN'=>'Usuario eliminado con exito !!! :-)']);
            }
            else{

                http_response_code(400);
                echo json_encode(['ERROR'=>'No existe el usuario :-(']);
            }
        }
        else{

            http_response_code(403);
            echo json_encode(['ERROR'=>'No posee los permisos necesarios :-(']);
        }
    }

}
