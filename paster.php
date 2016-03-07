<?php

class Paster {
    function __construct() {
        require_once 'db_connect.php';
        $this->DBM = $DBM;
    }

    function addPaste($content, $title) {
        $ID = $this->getID($content);
        $IP = $_SERVER['REMOTE_ADDR'];
        $this->DBM->insertIntoPastes($ID, $title, $content, $IP);

        echo $ID . ' - ' . $content . ' - ' . $IP;
    }

    function removePaste() {

    }

    function getID($text) {
        return sha1($text . microtime());
    }
}

?>
