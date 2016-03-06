<?php

require_once 'controller.php';
require_once 'paster.php';

$p = new Paster();



?>

<html>
    <head>

    </head>
    <body>
        <h1>Hi there</h1>

        <?php
        for ($i = 0; $i < 100; $i++) {
            $p->getNextUrl();
        }
        ?>
    </body>
</html>
