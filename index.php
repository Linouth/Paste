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
        <form method="POST" action="index.php">
            <textarea name="content" style="width: 500px; height:100px;"></textarea>
            <input type="text" name="title" />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </body>
</html>
