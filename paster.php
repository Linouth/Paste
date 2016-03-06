<?php

class Paster {
    function __construct() {
        // require_once "db_connect.php";
        // $this->DBM = $DBM;

        $this->pasteid = 'ad';
    }

    function addPaste() {

    }

    function removePaste() {

    }

    function getNextUrl() {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';        // Allowed characters
        $pasteid = $this->pasteid;                                                      // Current id

        echo $pasteid . "<br />";
        $newid = '';
        if (strlen($pasteid) == 0) {
            $pasteid = $str[0];                                 // Set $pasteid to first char of $str
        } else {
            for ($c = strlen($pasteid)-1; $c >= 0; $c--) {
                echo '- ' . $c . '<br />';
                if ($pasteid[$c] == substr($str, -1)) {
                    $newid[$c-1] = $this->nextChar($newid[$c-1], $str);
                    $newid[$c] = $str[0];
                    break;
                } else {
                    $newid = $newid . $pasteid;
                    $newid[$c] = $this->nextChar($newid[$c], $str);
                    break;
                }
            }



            /*
            for ($o = 0; $o < strlen($pasteid); $o++) {         // For every char in $pasteid
                $char = strpos($str, $pasteid[$o]);             // Char in $pasteid

                if ($pasteid[strlen($pasteid)-$o])


                if ($char == strlen($str)-1) {                  // If $char is '9'
                    echo 'temp ' . substr($str, -1);
                    // $newid = $str[0] .  $str[0];
                    if ($o < strlen($pasteid)) {

                    } else {
                        $newid = $str[0] . $str[0];
                    }
                } else {
                    $newid .= $str[$char + 1];                  // Add next char to $newid
                }
            }
            */
            $pasteid = $newid;
        }
        $this->pasteid = $pasteid;
    }

    function nextChar($currChar, $charList) {
        $curr = strpos($charList, $currChar);
        return $charList[$curr+1];
    }
}

?>
