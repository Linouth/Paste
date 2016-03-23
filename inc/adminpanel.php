
<?php if (isset($_SESSION['logged']) && $_SESSION == true): ?>
    <a class="adminpanelbtn btn" href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . Paster::getBaseDir() . 'admin'; ?>">Admin Panel</a>
<?php endif; ?>
