<?php
namespace app\controllers;

use core\Carrito;
use app\mail\Mail;

class PedidoController{

    public static function index($req,$param){

        $_SESSION['carrito'] = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : new Carrito;

        $carrito = $_SESSION['carrito'];
        $mensaje = empty($_SESSION['mensaje']) ? '' : $_SESSION['mensaje'] ;

        require_once('../app/views/pedido.php');
    }

    public static function presupuesto($req,$param){

        $_POST['Nombre'] = trim($_POST['Nombre']);
        $_POST['email'] = trim($_POST['email']);
    
        if((!empty($_SESSION['carrito']->items())) && (!empty($_POST['Nombre'])) && (!empty($_POST['email']))){

            $registros = $_SESSION['carrito']->toArray();
            $presupuesto = 0.0;

            $body = "<P>Buenas el cliente: <b>{$_POST['Nombre']}</b> correo: <b>{$_POST['email']}</b> relizo la solicitud del siguiente presupuesto:</P><br>";
            
            $body.= "<table border='1px'>
                            
            <tr>
                <th>Id Producto</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>";

            foreach($registros as $dato){

                $body.="
                <tr>
                    <td>{$dato['producto']['id']}</td>
                    <td> {$dato['producto']['nombre']} </td>
                    <td> {$dato['producto']['precio']} $</td>
                    <td>{$dato['cantidad']}</td>
                    <td>{$dato['total']} $</td>
                </tr>";

                $presupuesto = $presupuesto + $dato['total'];
            }

            $body.="</table>";

            $body.= "<P>Total del presupuesto: <b style='color:green;'>$presupuesto $</b></P>";
            
            $mail = new Mail('Showroom@example.com','Administrador@example.com','Pedido Carrito',$body);
        
            $req->mailer->enviar($mail);

            $_SESSION['mensaje'] = '<span style="color:green;">El mensaje ha sido enviado</span>';
            
            header("location:/pedido");
        }
        else{

            $_SESSION['mensaje'] = '<span style="color:red;">ERROR: El carrito esta vacio o hay campos vacios :(</span>';  

            header("location:/pedido");
        }
    }

    public static function contacto($req,$param){

        $nombre = empty($_POST['nombre']) ? null : trim($_POST['nombre']);   
        $email =  empty($_POST['email']) ? null : trim($_POST['email']);
        $telefono = empty($_POST['telefono']) ? null : trim($_POST['telefono']);
        $localidad = empty($_POST['localidad']) ? null : trim($_POST['localidad']);
        $comentario = empty($_POST['comentario']) ? null : trim($_POST['comentario']);
        
        if(isset($nombre) && isset($email) && isset($telefono) && isset($localidad) && isset($comentario)){
            
            $body = "<p><b>Sr/ra:</b> $nombre <b>Correo:</b> $email <b>Telefono:</b> $telefono <b>Localidad:</b> $localidad </p>";
            $body.= "<p>$comentario</p>";
            
            $mail = new Mail('Showroom@example.com','Administrador@example.com','Consulta Cliente',$body);

            $req->mailer->enviar($mail);
            
            echo"
            <script>
                alert('El mensaje ha sido enviado');
                window.location.replace('http://127.0.0.1/');
            </script>";
        } 
        else{

            echo"
            <script>
                alert('¡¡¡ ERROR: hay campos vacios :( !!!');
                window.location.replace('http://127.0.0.1/');
            </script>";
        }
    }
}