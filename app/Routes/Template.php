<?php

use \Nuovatech\Neon\Http\Response;
use \Nuovatech\Template\Readwrap\View;

$obRouter->get('/', [
    function () {
        return new Response(200, View::template('a'));
    }
]);
