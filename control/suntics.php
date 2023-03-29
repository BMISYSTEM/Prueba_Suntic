<?php 
namespace controllers;
use Router\Router;
use model\suntic;
use Intervention\Image\ImageManagerStatic as image;
class suntics{
    public static function carga(Router $router){
        $error = [];
        $pdfs = suntic::all();


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            //carga de archivos al servidor y a la base de datos
            //actualiza el nombre si viene action actualizar
            if($_POST['action'] === 'actualizar'){
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $arr = [
                    'id' => $id,
                    'nombre' =>  $nombre 
                ];
                //se agrega al constructor
                $oldname = suntic::find($id);
                $actualizar = new suntic($arr);
                //se realiza la actualizacion en la base de dtaos
                $result = $actualizar->update();
                $ruta = '../document/pdf/';
                $archivo = '../document/pdf/'.$oldname->nombre."";
                $archivon = '../document/pdf/'.$nombre.".pdf";
                $files = $ruta.$nombre.".pdf";
                //se renombra el archivo 
                $rsulta = rename($archivo,$archivon);
                //valida el exito de la operacion y actualiza el arreglo con la lista de los pdf
                if($rsulta){
                    $error = "se actualizo de forma corecta";
                    $pdfs = suntic::all();
                }
            }else{
                //elimina el archivo del servidor y de la base de datos
                if($_POST['id']){
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $arr = [
                        'id' => $id
                    ];
                    //se llena el constructor
                    $eliminar = new suntic($arr);
                    $result = $eliminar->delete();
                    //se valida si existe
                    $existe_pdf = file_exists("../document/pdf/". $nombre);
                    //se elimina el archivo del servidor
                    if($existe_pdf){
                        unlink("../document/pdf/". $nombre);
                    }
                    if($result){
                        $error = "se elimino";
                        $pdfs = suntic::all();
                    }else{
                        $errores = "no se eleimino";
                    }
                }
                //si no hay documento manda en mensaje de error
                if($_FILES['file']['error']>0){
                    //erorr
                    $error = "registre un archivo";
                }else{
                    //se crea un nombre unico 
                    $nomarchivo = md5(uniqid(rand(),true));
                    $acep =array('application/pdf');
                    $limit_kb = 30000;
                    //se valida que sea pdf
                    if(in_array($_FILES['file']['type'],$acep)){
                        $ruta = '../document/pdf/';
                        $files = $ruta.$nomarchivo.".pdf";
                        //se crea la carpeta si no existe
                        if(!is_dir($ruta)){
                            mkdir($ruta);                
                        }else{
                            //se mueve el archivo cargado a la carpeta del servidor
                            $result = @move_uploaded_file($_FILES['file']['tmp_name'],$files);
                            if($result){
                                $error ="archivo registrado";
                                $arr = [
                                    'nombre' => $nomarchivo
                                ];
                                //se carga al constructor
                                $sunti = new suntic($arr);
                                //se crea en la base de datos
                                $result = $sunti->create();
                                $error = "registrado correctamente";
                                $pdfs = suntic::all();
                            }else{
                                $error = "archivo no cargado";
                            }
                        }
                    }else{
                        $error = "no se admiten archivos diferentes a pdf";
                    }
                }
            }
        }
        //se le pasa al router los errores si hay y la lista con los pdfs
        $router->render('paginas/suntic',[
            'error' => $error,
            'pdfs' => $pdfs
        ]);
    }
}






?>