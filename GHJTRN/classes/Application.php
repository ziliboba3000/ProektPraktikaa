<?php

    class Application {
        const VERSION = '0.0.1';
        const NAME = 'nexusbank';

        const VENDOR_FOLDER = 'classes';
        const VIEWS_FOLDER = 'views';

        readonly public string $router;
        readonly public string $script;
        readonly public bool $isApi;

        readonly object $db;

        private array $_modules;

        public $user;

        public function __construct() {
            $this->autoload();
            $this->db = new Db();

            $_SESSION['app'] = $this;

            if (isset($_COOKIE['identity'])) User::authThroughCookie($_COOKIE['identity']);

            $this->router = $_GET['router'];
            $this->script = $_GET['script'];
            $this->isApi = isset($_GET['api']) && $_GET['api'] === '1';

            unset($_GET['router']);
            unset($_GET['script']);
            unset($_GET['api']);
            
        }

        static public function instance() {
            return $_SESSION['app'];
        }

        public function render() {
            $path = self::VIEWS_FOLDER .'/'. $this->router .'/'. $this->script .'.php';
            if (file_exists($path)) require($path);
            else {
                $path = self::VIEWS_FOLDER .'/exceptions/404.php';
                require($path);
            };
        }

        private function autoload($subpath = '') {
            $dir = self::VENDOR_FOLDER . $subpath;
            foreach(scandir($dir) as $subdir) {
                if ($subdir != '.' && $subdir != '..' && $subdir != 'Application.php') {
                    if (is_dir($dir .'/'. $subdir)) $this->autoload($subpath .'/'. $subdir);
                    else {
                        $this->_modules[] = $dir .'/'. $subdir;
                        require_once($dir .'/'. $subdir);
                    }
                }
            }
        }
    }
?>