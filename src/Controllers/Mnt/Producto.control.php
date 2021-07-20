<?php

namespace Controllers\Mnt;

class Producto extends \Controllers\PrivateController 
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            "INS" => "Nuevo Producto Panel",
            "UPD" => "Actualizando %s - %s",
            "DSP" => "Detalle de %s - %s",
            "DEL" => "Eliminado %s - %s"
        );
        
        $viewData = array();
        $viewData["ModalTitle"] = "";
        $viewData["prdcod"] = 0;
        $viewData["prddsc"] = "";
        $viewData["prdprc"] = 0;
        $viewData["prdImgPrm"] = "";
        $viewData["prdImgScd"] = "";
        $viewData["readonly"] = '';
        $viewData["showCommitBtn"] = true;

        //if (isset($_POST["btnConfirmar"]))
        if ($this->isPostBack()) {
            $viewData["mode"] = $_POST["mode"];
            $viewData["prdcod"] = $_POST["prdcod"];
            $viewData["token"] = $_POST["token"];

            $this->verificarToken();
            if ($viewData["token"] != $_SESSION["productos_xss_token"]) {
                $time = time();
                $token = md5("productos" . $time);
                $_SESSION["productos_xss_token"] = $token;
                $_SESSION["productos_xss_token_tts"] = $time;
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_productos",
                    "Algo sucedio mal intente de nuevo"
                );
            }
            if ($viewData["mode"] != "DEL") {
                $viewData["prddsc"] = $_POST["prddsc"];
                $viewData["prdprc"] = $_POST["prdprc"];
                $viewData["prdImgPrm"] = $_POST["prdImgPrm"];
                $viewData["prdImgScd"] = $_POST["prdImgScd"];
            }
            switch($viewData["mode"]) {
                case "INS":
                    $ok = \Dao\ProductoPanel::addProducto(
                        $viewData["prddsc"],
                        $viewData["prdprc"],
                        $viewData["prdImgPrm"],
                        $viewData["prdImgScd"],
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Panel agregado Exitosamente"
                        );
                    }
                    break;
                case "UPD":
                    $ok = \Dao\ProductoPanel::updateProducto(
                        $viewData["prddsc"],
                        $viewData["prdprc"],
                        $viewData["prdImgPrm"],
                        $viewData["prdImgScd"],
                        $viewData["prdcod"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Panel actualizado Exitosamente"
                        );
                    }
                    break;
                case "DEL":
                    $ok = \Dao\ProductoPanel::deleteProducto(
                        $viewData["prdcod"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Panel eliminado Exitosamente"
                        );
                    }
                    break;
            }

        } else {
            $viewData["mode"] = $_GET["mode"];
            $viewData["prdcod"] = isset($_GET["id"])? $_GET["id"] : 0;
            $this->verificarToken();
        }

            //Visualizar los Datos
        if ($viewData["mode"] == "INS") {
            $viewData["ModalTitle"] = "Agregando nuevo Producto Panel";
        } else {
            //aqui obtenemos el registro por id.
            $ProductoItem = \Dao\ProductoPanel::getProductoById($viewData["prdcod"]);
        
            error_log(json_encode($ProductoItem));
            if (!$ProductoItem) {
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_productos",
                    "No existe el registro"
                );
            }
            // Mas rapido lazy developers
            \Utilities\ArrUtils::mergeFullArrayTo($ProductoItem, $viewData);
            $viewData["ModalTitle"] = sprintf(
                $ModalTitles[$viewData["mode"]],
                $viewData["prdcod"],
                $viewData["prddsc"]
            );

            if ($viewData["mode"] == "DEL" || $viewData["mode"] == "DSP") {
                $viewData["readonly"] = "readonly";
                $viewData["showCommitBtn"]  = $viewData["mode"] == "DEL";
            }
            
        }

        \Views\Renderer::render("mnt/producto", $viewData); 
    }

    private function verificarToken(){
        if (!isset($_SESSION["productos_xss_token"])) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_productos",
                "Algo sucedio mal intente de nuevo"
            );
        } else {
            $time = time();
            if ($time - $_SESSION["productos_xss_token_tts"] > 86400) {
                //24 * 60 * 60  horas * minutos * segundo
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_productos",
                    "Algo sucedio mal intente de nuevo"
                );
            }
        }
    }

}

/*
c#
import System.SQL.SqlConnection;

java

import java.utils.ArraList;

com.unicahiccnw.Main

com
 |- unicahiccnw
    |- Main.java

*/
?>
