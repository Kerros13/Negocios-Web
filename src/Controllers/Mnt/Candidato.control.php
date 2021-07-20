<?php

namespace Controllers\Mnt;

class Candidato extends \Controllers\PublicController 
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            "INS" => "Nuevo Candidato Panel",
            "UPD" => "Actualizando %s - %s",
            "DSP" => "Detalle de %s - %s",
            "DEL" => "Eliminado %s - %s"
        );

        $viewData = array();
        $viewData["ModalTitle"] = "";
        $viewData["candidato_id"] = 0;
        $viewData["candidato_identidad"] = "";
        $viewData["candidato_nombre"] = "";
        $viewData["candidato_edad"] = 0;
        $viewData["readonly"] = '';
        $viewData["showCommitBtn"] = true;

        //if (isset($_POST["btnConfirmar"]))
        if ($this->isPostBack()) {
            $viewData["mode"] = $_POST["mode"];
            $viewData["candidato_id"] = $_POST["candidato_id"];
            $viewData["token"] = $_POST["token"];

            $this->verificarToken();
            if ($viewData["token"] != $_SESSION["candidatos_xss_token"]) {
                $time = time();
                $token = md5("candidatos" . $time);
                $_SESSION["candidatos_xss_token"] = $token;
                $_SESSION["candidatos_xss_token_tts"] = $time;
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_candidatos",
                    "Algo sucedio mal intente de nuevo"
                );
            }
            if ($viewData["mode"] != "DEL") {
                $viewData["candidato_identidad"] = $_POST["candidato_identidad"];
                $viewData["candidato_nombre"] = $_POST["candidato_nombre"];
                $viewData["candidato_edad"] = $_POST["candidato_edad"];
            }
            switch($viewData["mode"]) {
                case "INS":
                    $ok = \Dao\CandidatoPanel::addCandidato(
                        $viewData["candidato_identidad"],
                        $viewData["candidato_nombre"],
                        $viewData["candidato_edad"],
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_candidatos",
                            "Candidato Panel agregado Exitosamente"
                        );
                    }
                    break;
                case "UPD":
                    $ok = \Dao\CandidatoPanel::updateCandidato(
                        $viewData["candidato_identidad"],
                        $viewData["candidato_nombre"],
                        $viewData["candidato_edad"],
                        $viewData["candidato_id"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_candidatos",
                            "Candidato Panel actualizado Exitosamente"
                        );
                    }
                    break;
                case "DEL":
                    $ok = \Dao\CandidatoPanel::deleteCandidato(
                        $viewData["candidato_id"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_candidatos",
                            "Candidato Panel eliminado Exitosamente"
                        );
                    }
                    break;
            }

        } else {
            $viewData["mode"] = $_GET["mode"];
            $viewData["candidato_id"] = isset($_GET["id"])? $_GET["id"] : 0;
            $this->verificarToken();
        }

            //Visualizar los Datos
        if ($viewData["mode"] == "INS") {
            $viewData["ModalTitle"] = "Agregando nuevo Candidato Panel";
        } else {
            //aqui obtenemos el registro por id.
            $CandidatoItem = \Dao\CandidatoPanel::getCandidatoById($viewData["candidato_id"]);
        
            error_log(json_encode($CandidatoItem));
            if (!$CandidatoItem) {
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_candidatos",
                    "No existe el registro"
                );
            }
            // Mas rapido lazy developers
            \Utilities\ArrUtils::mergeFullArrayTo($CandidatoItem, $viewData);
            $viewData["ModalTitle"] = sprintf(
                $ModalTitles[$viewData["mode"]],
                $viewData["candidato_id"],
                $viewData["candidato_nombre"]
            );

            if ($viewData["mode"] == "DEL" || $viewData["mode"] == "DSP") {
                $viewData["readonly"] = "readonly";
                $viewData["showCommitBtn"]  = $viewData["mode"] == "DEL";
            }
            
        }

        \Views\Renderer::render("mnt/candidato", $viewData); 
    }

    private function verificarToken(){
        if (!isset($_SESSION["candidatos_xss_token"])) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_candidatos",
                "Algo sucedio mal intente de nuevo"
            );
        } else {
            $time = time();
            if ($time - $_SESSION["candidatos_xss_token_tts"] > 86400) {
                //24 * 60 * 60  horas * minutos * segundo
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_candidatos",
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
