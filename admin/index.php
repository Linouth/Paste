<?php
    // require_once '../inc/db_connect.php';
    require_once '../inc/paster.php';
    require_once '../inc/controller.php';

    $admin = true;

    $logged = false;
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
        header("Location:login.php");
        die();
    } else {
        $logged = $_SESSION['logged'];
    }

    $p = new Paster();

    if (isset($_POST['action']) && $logged) {
        $action = $_POST['action'];
        switch ($action) {
            case 'banIP':
                if (empty($_POST['ip'])) {
                    Paster::setError("IP address is required.");
                } else {
                    $p->addToBlacklist($_POST['ip']);
                }
                break;

            case 'unbanIP':
                if (empty($_POST['ip'])) {
                    Paster::setError("IP address is required.");
                } else {
                    if ($p->blacklisted($_POST['ip'])) {
                        $p->removeFromBlacklist($_POST['ip']);
                    } else {
                        Paster::setError("IP address is not blacklisted.");
                    }
                }
                break;

            case 'removeByIP':
                if (empty($_POST['ip'])) {
                    Paster::setError("IP address is required.");
                } else {
                    $p->removePasteFromIP($_POST['ip']);
                }
                break;

            case 'removeByID':
                if (empty($_POST['id'])) {
                    Paster::setError("PasteID is required.");
                } else {
                    $p->removePaste($_POST['id']);
                }
                break;

            case 'searchByIP':
                if (empty($_POST['ip'])) {
                    Paster::setError("IP address is required.");
                } else {
                    header('Location: http://' . $_SERVER['SERVER_NAME'] . Paster::getBaseDir() . "archive.php?page=1&ip=" . $_POST['ip']);
                }
                break;
        }
    }

    if ($logged):
?>

<html>
    <head>
        <?php include_once '../inc/head.php'; ?>
    </head>
    <body>
        <section id="container" class="admin">
            <?php include_once '../inc/header.php'; ?>
            <div class="heading">
                Admin Panel
                <span>Be careful.</span>
            </div>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="banIP" />
                <label>Ban IP:</label>
                <input type="text" name="ip" placeholder="IP to ban" />
                <input type="submit" name="submit" value="submit" />
            </form>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="unbanIP" />
                <label>Unban IP:</label>
                <select name="ip">
                    <?php
                        foreach($p->fetchBlacklist() as $ip) {
                            echo "<option value='$ip[1]'>$ip[1]</option>";
                        }
                    ?>
                </select>
                <!-- <input type="text" name="ip" placeholder="IP to unban" /> -->
                <input type="submit" name="submit" value="submit" />
            </form>

            <div class="sep"></div>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="removeByIP" />
                <label>Remove Posts by IP:</label>
                <input type="text" name="ip" placeholder="IP from which to remove all pastes" />
                <input type="submit" name="submit" value="submit" />
            </form>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="removeByID" />
                <label>Remove Paste by ID:</label>
                <input type="text" name="id" placeholder="Paste to remove" />
                <input type="submit" name="submit" value="submit" />
            </form>

            <div class="sep"></div>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="searchByIP" />
                <label>Search Pastes by IP:</label>
                <input type="text" name="ip" placeholder="IP to look up" />
                <input type="submit" name="submit" value="submit" />
            </form>
            <a href="logout.php" class="btn">Logout</a>
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

<?php endif; ?>
