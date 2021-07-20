<?php 
namespace Dao;

class PianoPanel extends Table{
    /*
    `pianoid` BIGINT(18) NOT NULL AUTO_INCREMENT,
    `pianodsc` VARCHAR(60) NULL,
    `pianobio` VARCHAR(5000) NULL,
    `pianosales` INT NULL,
    `pianoimguri` VARCHAR(128) NULL,
    `pianoimgthb` VARCHAR(128) NULL,
    `pianoprice` DECIMAL(13,2) NULL,
    `pianoest` CHAR(3) NULL,
    */
    public static function getActivePianos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from pianos where pianoest='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllPianos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from pianos;",
            array()
        );
        return $registros;
    }

    public static function getPianoById($id)
    {
        $sqlstr = "SELECT * from pianos where pianoid=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }
    

    public static function addPiano($pianodsc, $pianobio, $pianosales, $pianoimguri, $pianoimgthb, $pianoprice, $pianoest)
    {
        $insSQL = "INSERT INTO `pianos` (`pianodsc`, `pianobio`, `pianosales`, `pianoimguri`, `pianoimgthb`, `pianoprice`, `pianoest`) VALUES (:pianodsc, :pianobio, :pianosales, :pianoimguri, :pianoimgthb, :pianoprice, :pianoest);";
        $parameters = array(
            "pianodsc" => $pianodsc,
            "pianobio" => $pianobio,
            "pianosales" => $pianosales,
            "pianoimguri" => $pianoimguri,
            "pianoimgthb" => $pianoimgthb,
            "pianoprice" => $pianoprice,
            "pianoest" => $pianoest
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updatePiano($pianodsc, $pianobio, $pianosales, $pianoimguri, $pianoimgthb, $pianoprice, $pianoest, $pianoid)
    {
        $updSQL = "UPDATE `pianos` set `pianodsc`=:pianodsc, `pianobio`=:pianobio, `pianosales`=:pianosales, `pianoimguri`=:pianoimguri, `pianoimgthb`=:pianoimgthb, `pianoprice`=:pianoprice, `pianoest`=:pianoest where `pianoid` =:pianoid;";
        $parameters = array(
            "pianodsc" => $pianodsc,
            "pianobio" => $pianobio,
            "pianosales" => $pianosales,
            "pianoimguri" => $pianoimguri,
            "pianoimgthb" => $pianoimgthb,
            "pianoprice" => $pianoprice,
            "pianoest" => $pianoest,
            "pianoid" => $pianoid
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deletePiano($pianoid)
    {
        $delSQL = "DELETE FROM `pianos`  where `pianoid`=:pianoid;";
        $parameters = array(
            "pianoid" => $pianoid
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>
