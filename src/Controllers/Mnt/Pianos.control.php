<?php 

namespace Controllers\Mnt;

class Pianos extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmpPianos = \Dao\PianoPanel::getAllPianos();
        $viewData["pianos"] = array();
        $counter = 0;

        foreach ($tmpPianos as $pianos) {
            $counter ++;
            $pianos["rownum"] = $counter;
            $viewData["pianos"][] = $pianos;
        }
        $time = time();
        $token = md5("pianos". $time);
        $_SESSION["pianos_xss_token"] = $token;
        $_SESSION["pianos_xss_token_tts"] = $time;
        \Views\Renderer::render("mnt/pianos", $viewData);
    }
}

?>
