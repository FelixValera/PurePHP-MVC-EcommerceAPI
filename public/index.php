<?php

require_once '../autoload.php';
require_once '../vendor/PHPMailer/PHPMailer.php';
require_once '../vendor/PHPMailer/SMTP.php';
require_once '../vendor/PHPMailer/Exception.php';

use app\http\Server;
use app\http\Request;
use app\dataSource\MysqlDataSource;
use app\http\Middlewares\SessionStartMiddlewares;
use app\mail\mailer\PhpmailerMailer;
use app\http\Middlewares\AuthoMiddleware;

$server = new Server((new Request())->fromGlobal());

$server->use(function($req,$middleware){

    $req->datasource = MysqlDataSource::getInstance();
    $req->mailer = new PhpmailerMailer();

    $middleware->next($req);
});

//Definimos las peticiones de nuestra API
$server->if('/api',function($server){

    //Agregamos el middleware que valida el token
    $server->use(new AuthoMiddleware()); 
    //---------------------------API Producto-------------------------------------------
    $server->router()->get('/api/producto','app\controllers\ApiController::AllProducto')

    ->get('/api/producto/(\w+)','app\controllers\ApiController::OneProducto')

    ->post('/api/producto','app\controllers\ApiController::CreateProducto')

    ->put('/api/producto/(\w+)','app\controllers\ApiController::UpdateProducto')

    ->patch('/api/producto/(\w+)','app\controllers\ApiController::PatchProducto')

    ->delete('/api/producto/(\w+)','app\controllers\ApiController::DeleteProducto')

    //--------------------------API Categoria---------------------------------------------
    ->get('/api/categoria','app\controllers\ApiController::AllCategoria')

    ->get('/api/categoria/(\w+)','app\controllers\ApiController::OneCategoria')

    ->post('/api/categoria','app\controllers\ApiController::CreateCategoria')

    ->put('/api/categoria/(\w+)','app\controllers\ApiController::UpdateCategoria')

    ->patch('/api/categoria/(\w+)','app\controllers\ApiController::PatchCategoria')

    ->delete('/api/categoria/(\w+)','app\controllers\ApiController::DeleteCategoria')

    //--------------------------API Users-------------------------------------------------

    ->get('/api/usuario','app\controllers\ApiController::AllUsuario')

    ->get('/api/usuario/(\w+)','app\controllers\ApiController::OneUsuario')

    ->patch('/api/usuario/(\w+)','app\controllers\ApiController::PatchUsuario')

    ->delete('/api/usuario/(\w+)','app\controllers\ApiController::DeleteUsuario');
});

//Se definen las rutas del sitio web 
$server->not('/api',function($server){

    $server->use(new SessionStartMiddlewares());

    $server->router()->get('/','app\controllers\HomeController::index')   

    ->get('/categoria/(\w+)','app\controllers\CategoriaController::index')

    ->get('/categoria/(\w+)/producto/(\w+)','app\controllers\CategoriaController::producto')

    ->get('/pedido','app\controllers\PedidoController::index')

    ->post('/pedido/presupuesto','app\controllers\PedidoController::presupuesto')

    ->post('/contacto','app\controllers\PedidoController::contacto')

    ->get('/carrito/agregar/(\w+)','app\controllers\CarritoController::agregar')

    ->get('/carrito/incrementar/(\w+)','app\controllers\CarritoController::incrementar')

    ->get('/carrito/reducir/(\w+)','app\controllers\CarritoController::reducir')

    ->get('/carrito/eliminar/(\w)','app\controllers\CarritoController::eliminar')
    
    ->get('/register','app\controllers\RegisterController::index')

    ->post('/register/create','app\controllers\RegisterController::create');
});

$server->handler();