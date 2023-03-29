<?php 
require_once __DIR__ . '/../includes/app.php';
use router\Router;
use controllers\login;
use controllers\suntics;
//instancia la clase router
$router = new Router();
//se define las rutas de aceso y su funcion propiedades
$router->get('/',[login::class,'login']);
$router->post('/',[login::class,'logear']);
//carga de archivos privada
$router->get('/suntic',[suntics::class,'carga']);
$router->post('/suntic',[suntics::class,'carga']);
$router->comprobar_rutas(); 