<?php
class Router
{
    private const CONTROLLER_DIR = __DIR__ . '/Controller/';
    private string $controller;
    private string $action;

    public function __construct()
    {
        $this->controller = 'App\Controller\HomeController';
        $this->action = 'index';
    }


    public function loadController(): void
    {
        require self::CONTROLLER_DIR . 'AbstractController.php';

        spl_autoload_register(function (string $classname) {
            if (str_contains($classname, 'App\Entity\\')) {
                $classname = ltrim($classname, 'App\Entity\\');
                require $filename = 'Entity/' . ucfirst($classname) . '.php';
            } elseif (str_contains($classname, 'App\Repository\\')) {
                $classname = ltrim($classname, 'App\Repository\\');
                require $filename = 'Repository/' . ucfirst($classname) . '.php';
            } elseif (str_contains($classname, 'App\Service\\')) {
                $classname = ltrim($classname, "App\Service\\");
                require $filename = 'Service/' . ucfirst($classname) . '.php';
            }
        });

        if (isset($_GET['url'])) {
            $exploded = explode('/', $_GET['url']);
            $url = $exploded[1];
            $filename = self::CONTROLLER_DIR . ucfirst($url) . 'Controller.php';
            if (file_exists($filename)) {
                require $filename;
                $this->controller = "App\Controller\\".ucfirst($url).'Controller';
                if (isset($exploded[2]) && method_exists($this->controller, $exploded[2])) {
                    $this->action = $exploded[2];
                }
            } else {
                $filename = self::CONTROLLER_DIR . 'PageNotFoundController.php';
                require $filename;
                $this->controller = 'App\Controller\PageNotFoundController';
            }
        } else {
            $filename = self::CONTROLLER_DIR . 'HomeController.php';
            require $filename;
        }

        $controller = new $this->controller;
        $controller->{$this->action}();
    }
}
