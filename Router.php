<?php 
namespace Router;
class Router{
    public $rutasGet = [];
    public $rutasPost = [];
    public function get($url,$fn){
        $this->rutasGet[$url] = $fn;
    }
    public function post($url,$fn){
        $this->rutasPost[$url] = $fn;
    }
    //valida que la ruta exista si no existe se carga mensaje
    public function comprobar_rutas(){
        session_start();
        $aut = $_SESSION['login'];
        //arreglo de rutas protegidas
        $rutas_protegidas = ['/suntic'];
        // valida la ruta a la cual se esta ingresando
        $urlServert = $_SERVER['PATH_INFO'] ?? '/';
        //averigual el metodo por el cual se esta acediuendo a la ruta
        $metodo = $_SERVER['REQUEST_METHOD'];
        //valida que el metodo sea GET y extrae la funcion asociada
        if($metodo === 'GET'){
            $fn =$this->rutasGet[$urlServert] ?? null; 
        }else{
            $fn =$this->rutasPost[$urlServert] ?? null;
        }
        // compueba si la ruta es o no privada si esta dentro del arreglo 
        if(in_array($urlServert,$rutas_protegidas) && !$aut){
            header('Location: /');
        }
        if($fn){
            call_user_func($fn,$this);
        }else{
            echo "pagina no encontrada";
        }
        //si la ruta existe 
    }
    //muestra una vista 
    public function render($view,$datos = []){
        foreach($datos as $keys=>$valores){
            $$keys = $valores;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}
?>