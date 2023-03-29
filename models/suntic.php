<?php
namespace model;
use Intervention\Image\ImageManagerStatic as image;
class suntic extends ActiveRecord{
    protected static $tablas = 'archivos';
    protected static $columbnasdb = ['id','nombre'];

    public $id;
    public $nombre;
    public function __construct($arg = []){
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? '';
    }
    public function create()
    {
    $querys = "INSERT INTO " . static::$tablas;
    $querys .= " (nombre) values ('";
    $querys .= $this->nombre . ".pdf');";
    $result = self::$db->query($querys);  
    return $result;
    }
    public function delete()
    {
    $querys = "DELETE FROM " . static::$tablas;
    $querys .= " WHERE ID = '" . $this->id . "' limit 1 ;";
    $result = self::$db->query($querys);  
    return $result;
    }
    public function update()
    {
    $querys = "UPDATE " . static::$tablas;
    $querys .= " SET nombre = '" . $this->nombre . ".pdf'" ;
    $querys .= " WHERE id = '" . $this->id . "' limit 1 ;";
    $result = self::$db->query($querys);  
    return $result;
    }
}


?>