<?php

    require_once '../inc/paster.php';

    $admin = true;

    if (isset($_POST['username']) && isset($_POST['password'])) {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = 'Admin';
            $pass = '$2y$10$JUITbVJIU1ecjeQGtE2QgeasKcoYDPHrL9SoDHULE0U0UcoAbYNSW';
            if ($_POST['username'] == $user && password_verify($_POST['password'], $pass)) {
                session_start();
                $_SESSION['logged'] = true;
                header("Location:index.php");
                die();
            } else {
                Paster::setError("Wrong username or password.");
            }
        } else {
            Paster::setError("Please fill out both fields.");
        }
    }

?>

<html>
    <head>
        <?php include_once '../inc/head.php'; ?>
    </head>
    <body>
        <section id="container" class="login">
            <?php include_once '../inc/header.php'; ?>
            <div class="heading">
                Login
                <span>Be careful.</span>
            </div>

            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" />
                <input type="password" name="password" placeholder="Password" />
                <input type="submit" name="submit" value="Login" />
            </form>
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
