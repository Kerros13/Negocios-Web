<?php 

namespace Controllers\Mnt;

class Almacenes extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmpAlmacenes = \Dao\AlmacenPanel::getAllAlmacenes();
        $viewData["almacenes"] = array();
        $counter = 0;

        foreach ($tmpAlmacenes as $almacenes) {
            $counter ++;
            $almacenes["rownum"] = $counter;
            $viewData["almacenes"][] = $almacenes;
        }
        $time = time();
        $token = md5("almacenes". $time);
        $_SESSION["almacenes_xss_token"] = $token;
        $_SESSION["almacenes_xss_token_tts"] = $time;
        \Views\Renderer::render("mnt/almacenes", $viewData);
    }
}

?>
