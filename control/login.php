<?php
namespace controllers;
use Router\Router;
use model\logins;
class login{
    public static function login(Router $router){
        // $errores =[];
        // $pass = password_hash('12345',PASSWORD_BCRYPT);
       
        $router->render('paginas/login',[
        ]);
    }
    public static function logear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // echo json_encode($_POST);
            $utentic = new logins($_POST);
            $errores = $utentic->validar();
            if($errores){
                echo json_encode($errores);
            }
            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $utentic->exits();
                // echo json_encode($resultado);
                if (!$resultado) {
                    $errores[] = logins::getErrores();
                    echo json_encode("usuario no encontrado");
                }else{
                    //verificar pass
                    $autenticado = $utentic->password($resultado);
                    //autenticar usuario
                    if($autenticado){
                        $_SESSION['usuario'] = $_POST['email'];
                        $_SESSION['login'] = true;
                        echo json_encode("true");
                        // $utentic->autenticado();
                    }else{
                        $errores[] = logins::getErrores();
                        echo json_encode('el password no es correcto');
                        // debugear($errores);
                    }
                }
            }
        }
    }
}
?>