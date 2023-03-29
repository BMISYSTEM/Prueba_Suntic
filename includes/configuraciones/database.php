<?php

function conectardb() : mysqli{
    $db = new mysqli('localhost','root','Atenea.99','prueba_suntic');
    if(!$db){
        echo "error de conexion";
        exit;
    }
    return $db;
}