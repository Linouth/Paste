<?php

require_once 'controller.php';
session_start();

class Paster {
    private static $baseDir = "/Paste/";
    private static $error = '';

    public function __construct() {
        require_once 'db_connect.php';
        $this->DBM = $DBM;
        $this->DBH = $DBH;
    }

    public function addPaste($content, $title, $pub) {
        $IP = $_SERVER['REMOTE_ADDR'];

        if ($this->blacklisted($IP)) {
            self::setError("Your IP has been banned.");
        } else {
            if ($this->isPubValid($pub)) {
                $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
                $ID = $this->getID($content);
                $this->DBM->insertIntoPastes($ID, $title, $content, $pub, $IP);

                $curUrl = empty($_SERVER['PATH_INFO']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PATH_INFO'];

                header('Location: http://' . $_SERVER['SERVER_NAME'] . self::$baseDir . "paste.php?p=$ID");
                die();
            } else {
                self::setError("Nice try.");
            }
        }
    }
    private function isPubValid($pub) {
        $valid = array('public', 'unlist');
        if (in_array($pub, $valid)) {
            return true;
        }
        return false;
    }

    public function removePaste($id) {
        $this->DBM->deleteWhere('Paster', 'pasteID', $id);
    }
    public function removePasteFromIP($ip) {
        $this->DBM->deleteWhere('Paster', 'ip', $ip);
    }

    public function getRecentPastes($amount, $offset=0, $ip=null) {
        require_once 'paste.php';
        $query = "SELECT * FROM Paster WHERE pub='public' ORDER BY id DESC LIMIT $offset, $amount";
        if ($ip != null) {
            $query = "SELECT * FROM Paster WHERE pub='public' AND ip=? ORDER BY id DESC LIMIT $offset, $amount";
        }
        $sql = $this->DBH->prepare($query);
        $sql->execute(array($ip));

        $output = array();
        while($row = $sql->fetch()) {
            $output[] = Paste::useData($row);
        }

        return $output;
    }

    private function getID($text) {
        return sha1($text . microtime());
    }
    public static function getBaseDir() {
        return self::$baseDir;
    }

    public function addToBlacklist($ip) {
        $this->DBM->insertIntoBlacklist($ip);
    }
    public function removeFromBlacklist($ip) {
        $this->DBM->deleteWhere('Blacklist', 'ip', $ip);
    }
    public function blacklisted($ip) {
        $fetch = $this->DBM->fetchFromBlacklist($ip);
        if (!empty($fetch)) {
            return true;
        }
        return false;
    }
    public function fetchFromBlacklist($ip) {
        return $this->DBM->fetchFromBlacklist($ip);
    }
    public function fetchBlacklist() {
        return $this->DBM->fetchAll('Blacklist', 'id');
    }

    public static function setError($msg) {
        self::$error .= "$msg ";
    }
    public static function getError() {
        $output = self::$error;
        self::$error = '';
        if (strlen($output) > 0) return "<div id='error'>$output</div>";
    }
}

?>
