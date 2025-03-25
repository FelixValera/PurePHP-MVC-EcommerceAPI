<?php
namespace app\controllers;

use app\repositories\ProductoRepository;
use core\Carrito;

class CarritoController{

    public static function agregar($req,$param){

        $productos = new ProductoRepository($req->datasource);

        $articulo = $productos->findById($param[0]);

        $_SESSION['carrito'] = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : new Carrito;
        
        if(count($_SESSION['carrito']->items())!=10){

            $_SESSION['mensaje']='';

            if($_SESSION['carrito']->contiene($articulo)){

                $_SESSION['carrito']->incrementar($articulo);
            }
            else{
        
                $_SESSION['carrito']->agregar($articulo);
            }
        }
        else{
            $_SESSION['mensaje']= '<p style=color:red;>¡¡¡ATENCION Carrito lleno!!! solo se permiten 10 articulos<p>';
        }

        header("location:/pedido");
    }

    public static function incrementar($req,$param){

        $carrito = $_SESSION['carrito']->items();

        $articulo = $carrito[$param[0]];

        $articulo->incrementar();

        $_SESSION['mensaje'] = '';

        header("location:/pedido");

    }

    public static function reducir($req,$param){

        $carrito = $_SESSION['carrito']->items();

        $articulo = $carrito[$param[0]];

        $articulo->reducir();

        $_SESSION['mensaje'] = '';

        header("location:/pedido");
    }

    public static function eliminar($req,$param){

        $carrito = $_SESSION['carrito']->items();

        $articulo = $carrito[$param[0]];
    
        $_SESSION['carrito']->quitar($articulo->producto);

        $_SESSION['mensaje'] = '';

        header("location:/pedido");
    }
}
