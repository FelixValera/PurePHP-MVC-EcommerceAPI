<?php
namespace app\controllers;

use app\repositories\CategoriaRepository;
use app\repositories\ProductoRepository;

class CategoriaController{

    public static function index($req,$param){

        $categorias = new CategoriaRepository($req->datasource);
        $productos = new ProductoRepository($req->datasource);
        
        $categoria = $categorias->findById($param[0]);
        $articulos = $productos->find('id_categoria','=',$param[0]);
        
        require_once('../app/views/categoria.php');
    }

    public static function producto($req,$param){

        $categorias = new CategoriaRepository($req->datasource);
        $productos = new ProductoRepository($req->datasource);

        $categoria = $categorias->findById($param[0]);
        $producto = $productos->findById($param[1]);
    
        require_once('../app/views/detalle.php');
    }
}