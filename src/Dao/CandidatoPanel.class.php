<?php 
namespace Dao;

class CandidatoPanel extends Table{
    /*
    `candidato_id` INT NOT NULL AUTO_INCREMENT,
    `candidato_identidad` VARCHAR(16) NOT NULL,
    `candidato_nombre` VARCHAR(45) NULL,
    `candidato_edad` INT NULL,
    */

    public static function getAllCandidatos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from candidatos;",
            array()
        );
        return $registros;
    }

    public static function getCandidatoById($id)
    {
        $sqlstr = "SELECT * from candidatos where candidato_id=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }
    

    public static function addCandidato($candidato_identidad, $candidato_nombre, $candidato_edad)
    {
        $insSQL = "INSERT INTO `candidatos` (`candidato_identidad`, `candidato_nombre`, `candidato_edad`) VALUES (:candidato_identidad, :candidato_nombre, :candidato_edad);";
        $parameters = array(
            "candidato_identidad" => $candidato_identidad,
            "candidato_nombre" => $candidato_nombre,
            "candidato_edad" => $candidato_edad,
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateCandidato($candidato_identidad, $candidato_nombre, $candidato_edad, $candidato_id)
    {
        $updSQL = "UPDATE `candidatos` set `candidato_identidad`=:candidato_identidad, `candidato_nombre`=:candidato_nombre, `candidato_edad`=:candidato_edad, `candidato_id`=:candidato_id;";
        $parameters = array(
            "candidato_identidad" => $candidato_identidad,
            "candidato_nombre" => $candidato_nombre,
            "candidato_edad" => $candidato_edad,
            "candidato_id" => $candidato_id,
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteCandidato($candidato_id)
    {
        $delSQL = "DELETE FROM `candidatos`  where `candidato_id`=:candidato_id;";
        $parameters = array(
            "candidato_id" => $candidato_id
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>
