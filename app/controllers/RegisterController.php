<?php
namespace app\controllers;

use app\repositories\UsuarioRepository;
use core\Usuario;
use app\token\MiJwt;
use app\mail\Mail;

class RegisterController{

    public static function index($req,$param){

        require_once('../app/views/register.php');
    }

    public static function create($req,$param){

        if(!empty($_POST['email']) && !empty($_POST['password'])){
            
            $email = trim($_POST['email']);
            $db = new UsuarioRepository($req->datasource);

            if(!is_array($db->find('email','=',$email))){

                $password = password_hash(trim($_POST['password']),PASSWORD_DEFAULT); 
                $usuario = new Usuario(0,$email,$password);

                //creamos el token del usuario 
                $miJwt = new MiJwt();
                $token = $miJwt->encode($usuario);
                $usuario->api_Key = $token;

                //Insertamos en la base de datos
                $db->create($usuario);

                //Se manda un correo al usuario con el token
                $body = "<p><b>Sr/ra:</b> $email Gracias por registrarse !! con el siguiente token tendra acceso a nuestra API </p><br>";
                $body.= "<p><b>Token: </b>$token</p>";
                
                $mail = new Mail('Showroom@example.com',$email,'Showroom API Access',$body);
                
                $req->mailer->enviar($mail);
                echo"
                <script>
                    alert('Gracias por registrarse !!. Revise su correo :)');
                    window.location.replace('http://127.0.0.1/');
                </script>";
            } 
            else{
                echo"
                <script>
                    alert('¡¡¡ ERROR: El usuario ya existe :( !!!');
                    window.location.replace('http://127.0.0.1/');
                </script>";

            }
            
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
