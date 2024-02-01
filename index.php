<?php 

spl_autoload_register(function($classPath) {
    if (file_exists($filePath = $classPath . ".php")) require_once($filePath);
});

use Config\Links;
use Core\Route;

$controllers = (new Links())->getAll();

foreach ($controllers as $controller) {
    $methods = (new ReflectionClass($controller))->getMethods();
    foreach ($methods as $method) {
        $deps = [];
        $refParams = $method->getParameters();
        foreach ($refParams as $param) {
            $depClass = (string) $param->getType();
            $deps[] = new $depClass();
        }

        $attrs = $method->getAttributes(Route::class);
        foreach ($attrs as $attr) {
            if ($attr->getArguments()[0] === $_SERVER['REQUEST_METHOD'] && 
                $attr->getArguments()[1] === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
                $method->invoke(new $controller, ...$deps);
                exit();
            }
        }
    }
}

readfile('templates/notfound.html');