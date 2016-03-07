<?php

    class Paste {
        function __construct($ID = null) {
            require_once 'db_connect.php';

            if ($ID != null) {
                $paste = $DBM->fetchPaste($ID);
                if (empty($paste)) {
                    // Paste not found.
                } else {
                    $this->content = $paste['content'];
                    $this->title = $paste['title'];
                    $this->ip = $paste['ip'];
                    $this->id = $paste['pasteID'];
                }
            }
        }

        public function getTitle() {
            return $this->title;
        }
        public function getContent() {
            return $this->content;
        }
        public function getIP() {
            return $this->ip;
        }
        public function getID() {
            return $this->id;
        }
    }

    if (isset($_GET['p'])) {
        // Paste ID is set, load paste from database.
        $p = new Paste($_GET['p']);

        echo $p->getTitle() .
             '<br />' .
             $p->getContent() .
             '<br />' .
             $p->getIP() .
             '<br />' .
             $p->getID();
    }

?>
