<?php 

namespace Controllers\Mnt;

class Productos extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $tmpProductos = \Dao\ProductoPanel::getAllProductos();
        $viewData["productos"] = array();
        $counter = 0;

        foreach ($tmpProductos as $productos) {
            $counter ++;
            $productos["rownum"] = $counter;
            $viewData["productos"][] = $productos;
        }
        $time = time();
        $token = md5("productos". $time);
        $_SESSION["productos_xss_token"] = $token;
        $_SESSION["productos_xss_token_tts"] = $time;
        \Views\Renderer::render("mnt/productos", $viewData);
    }
}

?>
