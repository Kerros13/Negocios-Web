<?php

namespace Controllers\Mnt;

class Almacen extends \Controllers\PublicController 
{

    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            "INS" => "Nuevo Almacen Panel",
            "UPD" => "Actualizando %s - %s",
            "DSP" => "Detalle de %s - %s",
            "DEL" => "Eliminado %s - %s"
        );

        $viewData = array();
        $viewData["ModalTitle"] = "";
        $viewData["almacenId"] = 0;
        $viewData["almacenCodInstitucional"] = "";
        $viewData["almacenNombre"] = "";
        $viewData["almacenTipo"] = 'ARP';
        $viewData["almacenEstado"] = 'OPE';
        $viewData["almacenDireccion"] = "";
        $viewData["Latitud"] = 0;
        $viewData["Longitud"] = 0;
        $viewData["readonly"] = '';
        $viewData["showCommitBtn"] = true;
        $viewData["almacenEstado_ina"] = ''; //No se usa
        $viewData["almacenEstado_ope"] = ''; //Se esta usando
        $viewData["almacenEstado_enc"] = ''; //Se esta liquidando
        $viewData["almacenEstado_enl"] = ''; //No se puede hacer ningun movimiento, almacen en investigacion
        $viewData["almacenTipo_arp"] = ''; // Almacen de Recepción de Producto
        $viewData["almacenTipo_adi"] = ''; // Almacén de Distribución
        $viewData["almacenTipo_atr"] = ''; // Almacén de Transporte
        $viewData["almacenTipo_ade"] = ''; // Almacén de Despacho
        $viewData["almacenTipo_aca"] = ''; // Almacén de Canje

        //if (isset($_POST["btnConfirmar"]))
        if ($this->isPostBack()) {
            $viewData["mode"] = $_POST["mode"];
            $viewData["almacenId"] = $_POST["almacenId"];
            $viewData["token"] = $_POST["token"];

            $this->verificarToken();
            if ($viewData["token"] != $_SESSION["almacenes_xss_token"]) {
                $time = time();
                $token = md5("almacenes" . $time);
                $_SESSION["almacenes_xss_token"] = $token;
                $_SESSION["almacenes_xss_token_tts"] = $time;
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_almacenes",
                    "Algo sucedio mal intente de nuevo"
                );
            }
            if ($viewData["mode"] != "DEL") {
                $viewData["almacenCodInstitucional"] = $_POST["almacenCodInstitucional"];
                $viewData["almacenNombre"] = $_POST["almacenNombre"];
                $viewData["almacenTipo"] = $_POST["almacenTipo"];
                $viewData["almacenEstado"] = $_POST["almacenEstado"];
                $viewData["almacenDireccion"] = $_POST["almacenDireccion"];
                $viewData["Latitud"] = $_POST["Latitud"];
                $viewData["Longitud"] = $_POST["Longitud"];
            }
            switch($viewData["mode"]) {
                case "INS":
                    $ok = \Dao\AlmacenPanel::addAlmacen(
                        $viewData["almacenCodInstitucional"],
                        $viewData["almacenNombre"],
                        $viewData["almacenTipo"],
                        $viewData["almacenEstado"],
                        $viewData["almacenDireccion"],
                        $viewData["Latitud"],
                        $viewData["Longitud"],
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_almacenes",
                            "Almacen Panel agregado Exitosamente"
                        );
                    }
                    break;
                case "UPD":
                    $ok = \Dao\AlmacenPanel::updateAlmacen(
                        $viewData["almacenCodInstitucional"],
                        $viewData["almacenNombre"],
                        $viewData["almacenTipo"],
                        $viewData["almacenEstado"],
                        $viewData["almacenDireccion"],
                        $viewData["Latitud"],
                        $viewData["Longitud"],
                        $viewData["almacenId"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_almacenes",
                            "Almacen Panel actualizado Exitosamente"
                        );
                    }
                    break;
                case "DEL":
                    $ok = \Dao\AlmacenPanel::deleteAlmacen(
                        $viewData["almacenId"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_almacenes",
                            "Almacen Panel eliminado Exitosamente"
                        );
                    }
                    break;
            }

        } else {
            $viewData["mode"] = $_GET["mode"];
            $viewData["almacenId"] = isset($_GET["id"])? $_GET["id"] : 0;
            $this->verificarToken();
            //$token = md5("almacenes" . time());
            //$_SESSION["almacenes_xss_token"] = $token;
        }

            //Visualizar los Datos
        if ($viewData["mode"] == "INS") {
            $viewData["ModalTitle"] = "Agregando nuevo Almacen Panel";
        } else {
            //aqui obtenemos el registro por id.
            $almacen = \Dao\AlmacenPanel::getAlmacenById($viewData["almacenId"]);
        
            error_log(json_encode($almacen));
            if (!$almacen) {
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_almacenes",
                    "No existe el registro"
                );
            }
            // Mas rapido lazy developers
            \Utilities\ArrUtils::mergeFullArrayTo($almacen, $viewData);
            $viewData["ModalTitle"] = sprintf(
                $ModalTitles[$viewData["mode"]],
                $viewData["almacenId"],
                $viewData["almacenNombre"]
            );
            $viewData["almacenTipo_arp"] = $viewData["almacenTipo"] == "ARP";
            $viewData["almacenTipo_adi"] = $viewData["almacenTipo"] == "ADI";
            $viewData["almacenTipo_atr"] = $viewData["almacenTipo"] == "ATR";
            $viewData["almacenTipo_ade"] = $viewData["almacenTipo"] == "ADE";
            $viewData["almacenTipo_aca"] = $viewData["almacenTipo"] == "ACA";

            $viewData["almacenEstado_ina"] = $viewData["almacenEstado"] == "INA";
            $viewData["almacenEstado_ope"] = $viewData["almacenEstado"] == "OPE";
            $viewData["almacenEstado_enc"] = $viewData["almacenEstado"] == "ENC";
            $viewData["almacenEstado_enl"] = $viewData["almacenEstado"] == "ENL";

            if ($viewData["mode"] == "DEL" || $viewData["mode"] == "DSP") {
                $viewData["readonly"] = "readonly";
                $viewData["showCommitBtn"]  = $viewData["mode"] == "DEL";
            }
            
        }

        \Views\Renderer::render("mnt/almacen", $viewData); 
    }

    private function verificarToken(){
        if (!isset($_SESSION["almacenes_xss_token"])) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_almacenes",
                "Algo sucedio mal intente de nuevo"
            );
        } else {
            $time = time();
            if ($time - $_SESSION["almacenes_xss_token_tts"] > 86400) {
                //24 * 60 * 60  horas * minutos * segundo
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_almacenes",
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
