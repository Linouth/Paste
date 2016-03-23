<?php
    class Paste {
        public function __construct() {
            $this->available = true;
        }

        public static function fetch($ID) {
            $instance = new self();
            $instance->fetchData($ID);
            return $instance;
        }
        public static function useData(array $data) {
            $instance = new self();
            $instance->fill($data);
            return $instance;
        }

        protected function fill(array $data) {
            $this->id = $data['pasteID'];
            $this->title = $data['title'];
            $this->content = $data['content'];
            $this->pub = $data['pub'];
            $this->ip = $data['ip'];
        }
        protected function fetchData($ID) {
            require_once './inc/db_connect.php';
            $paste = $DBM->fetchPaste($ID);
            if (empty($paste)) {
                $this->available = false;
            } else {
                $this->fill($paste);
            }
        }


        public function getTitle() {
            return $this->title;
        }
        public function getCroppedTitle($length) {
            if (strlen($this->title) > $length) {
                return substr($this->title, 0, $length-3) . "...";
            } else {
                return $this->title;
            }
        }
        public function getContent() {
            return $this->content;
        }
        public function getActualIP() {
            return $this->ip;
        }
        // public function getIP() {
        //     if ($this->ip == '::1') {
        //         return 'localhost';
        //     }
        //     return $this->ip;
        // }
        public function getIP() {
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                return ($this->ip == '::1') ? 'localhost' : $this->ip;
            } else {
                return $this->getMaskedIP();
            }
        }
        public function getMaskedIP() {
            $ip = explode('.', $this->ip);
            if ($ip[0] == '::1') {
                return 'localhost';
            }
            $ip = "$ip[0].$ip[1].***.***";
            return $ip;
        }
        public function getID() {
            return $this->id;
        }
        public function getPub() {
            return $this->pub;
        }
        public function isAvailable() {
            return $this->available;
        }

        public function getUrl() {
            return "http://" . $_SERVER["SERVER_NAME"] . Paster::getBaseDir() . "paste.php?p=" . $this->id;
        }
    }

    if (isset($_GET['p'])):
        require_once './inc/paster.php';
        $paste = Paste::fetch($_GET['p']);
        if ($paste->isAvailable()):
            $lines = substr_count($paste->getContent(), "\n") + 1;
            if (isset($_GET['r']) && $_GET['r'] == true):
                header("Content-Type:text/plain");
                echo htmlspecialchars_decode($paste->getContent(), ENT_QUOTES);
            else :
?>
<html>
    <head>
        <?php include_once './inc/head.php'; ?>
    </head>
    <body>
        <section id="container">
            <?php include_once './inc/header.php'; ?>

            <div id="postinfo" class="heading">
                <?php echo $paste->getTitle(); ?>
                <?php if (strlen($paste->getTitle()) > 20){
                    echo '<span class="nl">';
                } else {
                    echo '<span>';
                }
                ?>
                    (
                    <?php echo $paste->getPub(); ?>
                    <span>|</span>
                    <?php echo $paste->getID(); ?>
                    <span>|</span>
                    <?php echo $paste->getIP(); ?>
                    <span>|</span>
                    <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&r=true"; ?>">Get RAW</a>
                    )
                </span>
            </div>

            <div id="post" class="content">
                <div class="numbers">
                    <?php
                    for ($i = 1; $i <= $lines; $i++) {
                        echo "<div class='num mono'>$i</div>";
                    }
                    ?>
                </div>
                <pre class="mono"><?php echo $paste->getContent(); ?></pre>
            </div>

            <?php include_once './inc/adminpanel.php'; ?>
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

<?php
        endif;
    else:
        if (isset($_GET['r']) && $_GET['r'] == true):
            header("Content-Type:text/plain");
            echo "Paste not found.";
        else:
?>

<html>
    <head>
        <?php echo include_once './inc/head.php'; ?>
    </head>
    <body>
        <section id="container">
            <?php include_once './inc/header.php'; ?>

            <div id="post" class="content">
                <pre class="mono">Paste not found.</pre>
            </div>
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
<?php endif; ?>
<?php endif; ?>
