<?php 
namespace Dao;

class ProductoPanel extends Table{
    /*
    `prdcod` bigint(18) unsigned NOT NULL AUTO_INCREMENT,
    `prddsc` varchar(45) DEFAULT NULL,
    `prdprc` decimal(18,4) DEFAULT NULL,
    `prdImgPrm` varchar(255) DEFAULT NULL,
    `prdImgScd` varchar(255) DEFAULT NULL,
    */

    public static function getAllProductos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from productos;",
            array()
        );
        return $registros;
    }

    public static function getProductoById($id)
    {
        $sqlstr = "SELECT * from productos where prdcod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }
    

    public static function addProducto($prddsc, $prdprc, $prdImgPrm, $prdImgScd)
    {
        $insSQL = "INSERT INTO `productos` (`prddsc`, `prdprc`, `prdImgPrm`, prdImgScd) VALUES (:prddsc, :prdprc, :prdImgPrm, :prdImgScd);";
        $parameters = array(
            "prddsc" => $prddsc,
            "prdprc" => $prdprc,
            "prdImgPrm" => $prdImgPrm,
            "prdImgScd" => $prdImgScd,

        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateProducto($prddsc, $prdprc, $prdImgPrm, $prdImgScd, $prdcod)
    {
        $updSQL = "UPDATE `productos` set `prddsc`=:prddsc, `prdprc`=:prdprc, `prdImgPrm`=:prdImgPrm, `prdImgScd`=:prdImgScd, `prdcod`=:prdcod;";
        $parameters = array(
            "prddsc" => $prddsc,
            "prdprc" => $prdprc,
            "prdImgPrm" => $prdImgPrm,
            "prdImgScd" => $prdImgScd,
            "prdcod" => $prdcod,
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteProducto($prdcod)
    {
        $delSQL = "DELETE FROM `productos`  where `prdcod`=:prdcod;";
        $parameters = array(
            "prdcod" => $prdcod
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>
