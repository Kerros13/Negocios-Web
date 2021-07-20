<?php

namespace Controllers\Mnt;

class Piano extends \Controllers\PublicController 
{

    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            "INS" => "Nuevo Piano Panel",
            "UPD" => "Actualizando %s - %s",
            "DSP" => "Detalle de %s - %s",
            "DEL" => "Eliminado %s - %s"
        );

        $viewData = array();
        $viewData["ModalTitle"] = "";
        $viewData["pianoid"] = 0;
        $viewData["pianodsc"] = "";
        $viewData["pianobio"] = "";
        $viewData["pianosales"] = 0;
        $viewData["pianoimguri"] = "/public/img/piano/";
        $viewData["pianoimgthb"] = "/public/img/piano/";
        $viewData["pianoprice"] = 0;
        $viewData["pianoest"] = 'ACT';
        $viewData["readonly"] = '';
        $viewData["showCommitBtn"] = true;
        $viewData["pianoest_act"] = true;
        $viewData["pianoest_ina"] = false;

        //if (isset($_POST["btnConfirmar"]))
        if ($this->isPostBack()) {
            $viewData["mode"] = $_POST["mode"];
            $viewData["pianoid"] = $_POST["pianoid"];
            $viewData["token"] = $_POST["token"];

            $this->verificarToken();
            if ($viewData["token"] != $_SESSION["pianos_xss_token"]) {
                $time = time();
                $token = md5("pianos" . $time);
                $_SESSION["pianos_xss_token"] = $token;
                $_SESSION["pianos_xss_token_tts"] = $time;
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_pianos",
                    "Algo sucedio mal intente de nuevo"
                );
            }
            if ($viewData["mode"] != "DEL") {
                $viewData["pianodsc"] = $_POST["pianodsc"];
                $viewData["pianobio"] = $_POST["pianobio"];
                $viewData["pianosales"] = $_POST["pianosales"];
                $viewData["pianoimguri"] = $_POST["pianoimguri"];
                $viewData["pianoimgthb"] = $_POST["pianoimgthb"];
                $viewData["pianoprice"] = $_POST["pianoprice"];
                $viewData["pianoest"] = $_POST["pianoest"];
            }
            switch($viewData["mode"]) {
                case "INS":
                    $ok = \Dao\PianoPanel::addPiano(
                        $viewData["pianodsc"],
                        $viewData["pianobio"],
                        $viewData["pianosales"],
                        $viewData["pianoimguri"],
                        $viewData["pianoimgthb"],
                        $viewData["pianoprice"],
                        $viewData["pianoest"],
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_pianos",
                            "Piano Panel agregado Exitosamente"
                        );
                    }
                    break;
                case "UPD":
                    $ok = \Dao\PianoPanel::updatePiano(
                        $viewData["pianodsc"],
                        $viewData["pianobio"],
                        $viewData["pianosales"],
                        $viewData["pianoimguri"],
                        $viewData["pianoimgthb"],
                        $viewData["pianoprice"],
                        $viewData["pianoest"],
                        $viewData["pianoid"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_pianos",
                            "Piano Panel actualizado Exitosamente"
                        );
                    }
                    break;
                case "DEL":
                    $ok = \Dao\PianoPanel::deletePiano(
                        $viewData["pianoid"]
                    );
                    if ($ok) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_pianos",
                            "Piano Panel eliminado Exitosamente"
                        );
                    }
                    break;
            }

        } else {
            $viewData["mode"] = $_GET["mode"];
            $viewData["pianoid"] = isset($_GET["id"])? $_GET["id"] : 0;
            $this->verificarToken();
            //$token = md5("pianos" . time());
            //$_SESSION["pianos_xss_token"] = $token;
        }

            //Visualizar los Datos
        if ($viewData["mode"] == "INS") {
            $viewData["ModalTitle"] = "Agregando nuevo Piano Panel";
        } else {
            //aqui obtenemos el registro por id.
            $pianoItem = \Dao\PianoPanel::getPianoById($viewData["pianoid"]);
        
            error_log(json_encode($pianoItem));
            if (!$pianoItem) {
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_pianos",
                    "No existe el registro"
                );
            }
            // Mas rapido lazy developers
            \Utilities\ArrUtils::mergeFullArrayTo($pianoItem, $viewData);
            $viewData["ModalTitle"] = sprintf(
                $ModalTitles[$viewData["mode"]],
                $viewData["pianoid"],
                $viewData["pianodsc"]
            );
            $viewData["pianoest_act"] = $viewData["pianoest"] == "ACT";
            $viewData["pianoest_ina"] = $viewData["pianoest"] == "INA";

            if ($viewData["mode"] == "DEL" || $viewData["mode"] == "DSP") {
                $viewData["readonly"] = "readonly";
                $viewData["showCommitBtn"]  = $viewData["mode"] == "DEL";
            }
            
        }

        \Views\Renderer::render("mnt/piano", $viewData); 
    }

    private function verificarToken(){
        if (!isset($_SESSION["pianos_xss_token"])) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_pianos",
                "Algo sucedio mal intente de nuevo"
            );
        } else {
            $time = time();
            if ($time - $_SESSION["pianos_xss_token_tts"] > 86400) {
                //24 * 60 * 60  horas * minutos * segundo
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_pianos",
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
