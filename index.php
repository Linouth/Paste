<?php

require_once './inc/controller.php';
require_once './inc/paster.php';

$p = new Paster();

if (isset($_POST['content'])) {
    if (!empty($_POST['content'])) {
        $content = $_POST['content'] . ' ';
        $title = empty($_POST['title']) ? 'Untitled' : $_POST['title'];
        $p->addPaste($content, $title, $_POST['pub']);
    }
}
?>

<html>
    <head>
        <?php include_once './inc/head.php'; ?>
    </head>
    <body>
        <section id="container">
            <?php include_once './inc/header.php'; ?>

            <div id="input">
                <form method="POST" action="index.php">
                    <textarea class="mono content" name="content"></textarea>
                    <div>
                        <input type="text" name="title" placeholder="Title (optional)"/>
                        <select name="pub">
                            <option value="unlist">Unlisted</option>
                            <option value="public">Public</option>
                        </select>
                        <input type="submit" name="submit" value="Submit" />
                    </div>
                </form>
            </div>

            <div id="publics">
                <span class="heading">Public Posts</span>
                <div id="items">
                    <?php
                    $recent = $p->getRecentPastes(8);
                    foreach($recent as $paste) {
                        $title = $paste->getTitle();
                        if (strlen($title) > 17) {
                            $title = substr($paste->getTitle(), 0, 14) . "...";
                        }
                        echo "<a href='" . $paste->getUrl() . "' class='item'>" . $title . "</a>";
                    }
                    ?>
                </div>
            </div>
        </section>
        <div id="stars">
            <?php
            for ($i = 0; $i < 500; $i++) {
                $size = rand(1, 2);
                $x = rand(1, 2000);
                $y = rand(1, 1500);
                echo '<div class="star" style="left:' . $x . 'px; top: ' . $y . 'px; animation-delay: ' . $i*0.01 . 's; width: ' . $size . 'px; height: ' . $size . 'px;"></div>';
            }
            ?>
        </div>
    </body>
</html>
