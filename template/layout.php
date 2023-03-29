<?php

// Import View management class
use \Nuovatech\Template\Readwrap\View;

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta content="Nuovatech" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Bootstrap CSS -->
    <?php View::extras("Bootstrap/css/bootstrap.min", "css"); ?>

    <!-- FONTAWESOME CSS -->
    <?php View::extras("fontawesome"); ?>

    <!-- Style of Template -->
    <?php View::css("core", true); ?>

</head>

<body class="rw-template">

    <div class="rw-template-nav"></div>

    <div class="rw-template-body">

        <main class="rw-template-main">
            <?php View::getBody(); ?>
        </main>
        
    </div>

    <!-- Jquery -->
    <?php View::extras("Jquery"); ?>

    <!-- Bootstrap script -->
    <?php View::extras("Bootstrap/js/bootstrap.min", "script"); ?>
</body>

</html>