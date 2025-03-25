<?php
namespace app\controllers;

use app\repositories\CategoriaRepository;

class HomeController{

    public static function index($req,$param){

        $categoria = new CategoriaRepository($req->datasource);
    
        $catalogo = $categoria->findAll();

        $classArray = ['cat-item cat-item-l','cat-item cat-item-s','cat-item cat-item-s','cat-item cat-item-l'];    //solucion problema de diseño

        $i = 0;      // contador para recorrer classArray

        require_once('../app/views/index.php');
    }
}

