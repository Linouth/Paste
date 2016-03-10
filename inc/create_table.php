<?php

require_once 'db_connect.php';

$sql = $DBH->prepare('CREATE TABLE IF NOT EXISTS Paster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pasteID TEXT(40) NOT NULL,
    pub TEXT(16) NOT NULL,
    title TEXT(64),
    content MEDIUMTEXT NOT NULL,
    ip TEXT(32) NOT NULL
);');
$sql->execute();

$sql = $DBH->prepare('CREATE TABLE IF NOT EXISTS Blacklist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip TEXT(32) NOT NULL
);');
$sql->execute();

echo "Done.";
?>
