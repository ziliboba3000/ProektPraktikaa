<?php

    class Api extends Application {
        const INTERFACE_FOLDER = __DIR__ .'/../api/interfaces';

        public $user;
        
        readonly array $data;

        readonly public string $router;
        readonly public string $script;
        readonly public bool $isApi;
        
        readonly object $promt;
        readonly object $db;

        private $_modules;

        public function __construct() {
            foreach (Application::instance() as $prop => $value) $this->$prop = $value;
            $this->autoload();

            $this->data = $_REQUEST;

            $_SESSION['api'] = $this;
        }

        static public function instance() {
            return $_SESSION['api'];
        }

        public function execute(){
            $classname = strtoupper(substr($this->router, 0, 1)).substr($this->router, 1);
            if (class_exists($classname)) {
                try {
                    $method = $this->script;

                    return $classname::$method($this->data);
                } catch (Throwable $e) {
                    echo '<pre>';
                    print_r($e);
                    exit;
                }
            } else echo 'err - class does not exist';
        }


        private function autoload($subpath = '') {
            $dir = self::INTERFACE_FOLDER . $subpath;
            foreach(scandir($dir) as $subdir) {
                if ($subdir != '.' && $subdir != '..' && $subdir != 'Api.php') {
                    if (is_dir($dir .'/'. $subdir)) $this->autoload($subpath .'/'. $subdir);
                    else {
                        $this->_modules[strtolower(substr($subdir, 0, -4))] = substr($subdir, 0, -4);
                        require($dir .'/'. $subdir);
                    }
                }
            }
        }
    }
?>