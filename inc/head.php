<title>mPaste<?php if (isset($paste) && $paste->isAvailable()) echo ' - ' . $paste->getTitle(); ?></title>
<?php if (isset($admin) && $admin == true):?>
<link rel="stylesheet" href="../css/style.css" />
<?php else: ?>
<link rel="stylesheet" href="css/style.css" />
<?php endif; ?>
