<?php

require_once 'db_connect.php';

$sql = $DBH->prepare('CREATE TABLE Paster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pasteID TEXT(40) NOT NULL,
    pub TEXT(16) NOT NULL,
    title TEXT(64),
    content MEDIUMTEXT NOT NULL,
    ip TEXT(32) NOT NULL
);');
$sql->execute();

?>
