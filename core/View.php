<?php

namespace Nuovatech\Template\Readwrap;

use \Nuovatech\Neon\Http\Exception;
use \Nuovatech\Neon\Neon;
use \Nuovatech\Neon\View as NeonView;

/**
 * Manager the view interface of Neon viewer template
 */
abstract class View extends NeonView
{
    public static function css(string $path, $template = false)
    {
        $path = ($template == true) ? Neon::directory() . "assets/css/$path.css" : Neon::directory() . "public/assets/css/$path.css";
        print_r("<link href='$path' rel='stylesheet' type='text/css'> \r");
    }

    public static function extras(string $component, $type = false): void
    {
        $directory = Neon::directory() . "assets/extras/$component";

        $js = ("<script src='directory.js' type='text/javascript'></script> \r \t");
        $css = ("<link rel='stylesheet' href='directory.css' type='text/css'> \r \t");

        if ($type) {
            switch ($type) {
                case "css": {
                        print_r(str_replace("directory", "$directory", $css));
                        break;
                    }
                case "script": {
                        print_r(str_replace("directory", "$directory", $js));
                        break;
                    }
            }
        } else {
            switch ($component) {
                case "Bootstrap": {
                        print_r(str_replace("directory", "$directory/select2.min", $css));
                        print_r(str_replace("directory", "$directory/select2.min", $js));
                        break;
                    }
                case "fontawesome": {
                        print_r(str_replace("directory", "$directory/css/fontawesome", $css));
                        print_r(str_replace("directory", "$directory/css/brands", $css));
                        print_r(str_replace("directory", "$directory/css/solid", $css));
                        break;
                    }
                case "Jquery": {
                        print_r(str_replace("directory", "$directory/Jquery", $js));
                        break;
                    }
                case "Select2": {
                        print_r(str_replace("directory", "$directory/select2.min", $css));
                        print_r(str_replace("directory", "$directory/select2.min", $js));
                        break;
                    }
                default: {
                        print_r("<!-- File '$component' not found. -->");
                        break;
                    }
            }
        }
    }

    public static function template(string $path = '', array $vars = [], string $extension = "php"): void
    {
        try {

            // Load the layout
            $layout = __DIR__ . "/../template/layout.php";

            // Check file existence   
            if (!file_exists($layout)) {
                Exception::response(404, "Layout not found!");
            }

            // Load the content of view
            $view = "public/pages/$path.$extension";

            // Check page existence
            if (!file_exists($view)) {
                Exception::response(404, "Page not found!");
            }

            // Load params to body
            if (!empty($vars)) {
                self::setGlobal($vars);
            }

            // Define controller vars to view
            parent::setGlobal($vars);
            unset($vars);

            // Load the content body
            $body = file_get_contents($view);

            ob_start();
            eval("?>" . $body  . "<?php");
            $body  = ob_get_clean();
            parent::setBody($body);
            require $layout;
        } catch (\Throwable $th) {
            Exception::response($th->getCode(), $th->getMessage());
        }
    }
}
