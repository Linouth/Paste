<?php

    // require_once './inc/controller.php';
    require_once './inc/paster.php';

    $p = new Paster();
    $numOfPastes = 10;

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $offset = 10 * ($page-1);

    $ip = null;
    if (isset($_GET['ip']) && (isset($_SESSION['logged']) && $_SESSION['logged'] == true)) {
        $ip = $_GET['ip'];
    }

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

            <?php if (is_numeric($page)): ?>
                <div id="plist">
                    <?php
                        $recent = $p->getRecentPastes($numOfPastes, $offset, $ip);
                        foreach ($recent as $paste) {
                            // $ip = (isset($_SESSION['logged']) && $_SESSION['logged'] == true) ? $paste->getIP() : $paste->getMaskedIP();
                            echo '<a class="plist-item" href="' . $paste->getUrl() . '">' .
                                    '<span>' . $paste->getCroppedTitle(50) . '</span>' .
                                    '<span class="mono">' . $paste->getID() . '</span>' .
                                    '<span>' . $paste->getIP() . '</span>' .
                                 '</a>';
                        }
                    ?>
                    <?php $params = ($ip != null) ? "archive.php?ip=$ip&page=" : "archive.php?page=";
                    if ($page > 1): ?>
                        <a class="btn prevpage" href="<?php echo $params . strval($page-1); ?>">Previous Page</a>
                    <?php endif; ?>
                    <?php if (count($recent) > $numOfPastes): ?>
                        <a class="btn nextpage" href="<?php echo $params . strval($page+1); ?>">Next Page</a>
                    <?php endif; ?>
                    <?php include_once './inc/adminpanel.php'; ?>
                </div>
            <?php else: ?>
                Page not found.
            <?php endif; ?>


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
