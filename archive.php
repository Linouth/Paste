<?php

    // require_once './inc/controller.php';
    require_once './inc/paster.php';

    $p = new Paster();

    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $page = $_GET['p'];
    } else {
        $page = 1;
    }
    $offset = 10 * ($page-1);

?>

<html>
    <head>
        <?php include_once './inc/head.php'; ?>
    </head>
    <body>
        <section id="container">
            <?php include_once './inc/header.php'; ?>

            <div class="heading">
                Archive
                <span>Here you'll find old pastes.</span>
            </div>

            <div id="plist">
                <a class="plist-item">
                    <span>Paste Title</span>
                    <span>f4c74668ac3b5002a3ff1accb106f680f8885842</span>
                    <span>192.168.***.***</span>
                </a>
                <?php
                    $recent = $p->getRecentPastes(10, $offset);
                    foreach ($recent as $paste) {
                        echo "<a class='plist-item' href='" . $p->getUrl() . "'>" .
                                '<span>' . $p->getTitle() . '</span>' .
                                '<span>' . $p->getID() . '</span>' .
                                '<span>' . $p->getMaskedIP() . '</span>' .
                             "</a>";
                    }
                ?>
                <?php if ($page > 1): ?>
                    <a class="btn prevpage" href="archive.php?p=<?php echo $page-1; ?>">Previous Page</a>
                <?php endif; ?>
                <a class="btn nextpage" href="archive.php?p=<?php echo $page+1; ?>">Next Page</a>
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
