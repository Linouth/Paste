<?php

require_once './inc/controller.php';
require_once './inc/paster.php';

$p = new Paster();

if (isset($_POST['content'])) {
    if (!empty($_POST['content'])) {
        $content = $_POST['content'];
        $title = empty($_POST['title']) ? '' : $_POST['title'];
        $p->addPaste($_POST['content'], $title);
    }
}
?>

<html>
    <head>
        <title>Paste</title>
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/Vague.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <section id="container">
            <div id="input">
                <form method="POST" action="index.php">
                    <textarea name="content"></textarea>
                    <input type="text" name="title" />
                    <input type="submit" name="submit" value="Submit" />
                </form>
            </div>
        </section>
        <div id="stars">
            <?php
            for ($i = 0; $i < 500; $i++) {
                $size = rand(1, 2);
                $x = rand(1, 2000);
                $y = rand(1, 1500);
                echo '<div class="star" style="left:' . $x . 'px; top: ' . $y . 'px; animation-delay: ' . $i*0.005 . 's; width: ' . $size . 'px; height: ' . $size . 'px;"></div>';
            }
            ?>
        </div>
    </body>
</html>
