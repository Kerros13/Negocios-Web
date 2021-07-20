<?php 
namespace Dao;

class AlmacenPanel extends Table{
    /*
    `almacenId` BIGINT(18) NOT NULL AUTO_INCREMENT,
    `almacenCodInstitucional` VARCHAR(10) NOT NULL,
    `almacenNombre` VARCHAR(100) NULL,
    `almacenTipo` VARCHAR(50) NULL,
    `almacenEstado` CHAR(3) NULL,
    `almacenDireccion` VARCHAR(256) NULL,
    `Latitud` DECIMAL(9,6) NULL,
    `Longitud` DECIMAL(9,6) NULL,
    */
    public static function getActiveAlmacenes()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from almacen where almacenEstado NOT IN ('INA');",
            array()
        );
        return $registros;
    }

    public static function getAllAlmacenes()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from almacen;",
            array()
        );
        return $registros;
    }

    public static function getAlmacenById($id)
    {
        $sqlstr = "SELECT * from almacen where almacenId=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addAlmacen($almacenCodInstitucional, $almacenNombre, $almacenTipo, $almacenEstado, $almacenDireccion, $Latitud, $Longitud)
    {
        $insSQL = "INSERT INTO `almacen` (`almacenCodInstitucional`, `almacenNombre`, `almacenTipo`, `almacenEstado`, `almacenDireccion`, `Latitud`, `Longitud`) VALUES (:almacenCodInstitucional, :almacenNombre, :almacenTipo, :almacenEstado, :almacenDireccion, :Latitud, :Longitud);";
        $parameters = array(
            "almacenCodInstitucional" => $almacenCodInstitucional,
            "almacenNombre" => $almacenNombre,
            "almacenTipo" => $almacenTipo,
            "almacenEstado" => $almacenEstado,
            "almacenDireccion" => $almacenDireccion,
            "Latitud" => $Latitud,
            "Longitud" => $Longitud
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateAlmacen($almacenCodInstitucional, $almacenNombre, $almacenTipo, $almacenEstado, $almacenDireccion, $Latitud, $Longitud, $almacenId)
    {
        $updSQL = "UPDATE `almacen` set `almacenCodInstitucional`=:almacenCodInstitucional, `almacenNombre`=:almacenNombre, `almacenTipo`=:almacenTipo, `almacenEstado`=:almacenEstado, `almacenDireccion`=:almacenDireccion, `Latitud`=:Latitud, `Longitud`=:Longitud where `almacenId`=:almacenId;";
        $parameters = array(
            "almacenCodInstitucional" => $almacenCodInstitucional,
            "almacenNombre" => $almacenNombre,
            "almacenTipo" => $almacenTipo,
            "almacenEstado" => $almacenEstado,
            "almacenDireccion" => $almacenDireccion,
            "Latitud" => $Latitud,
            "Longitud" => $Longitud,
            "almacenId" => $almacenId
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteAlmacen($almacenId)
    {
        $delSQL = "DELETE FROM `almacen`  where `almacenId`=:almacenId;";
        $parameters = array(
            "almacenId" => $almacenId
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>