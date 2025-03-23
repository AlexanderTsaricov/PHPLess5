<?php
namespace Geekbrains\Application1;

use Geekbrains\Application1\Controllers\ErrorController;

class Application
{
    private const APP_NAMESPACE = "Geekbrains\Application1\Controllers\\";
    private string $controllerName;
    private string $methodName;

    public function run()
    {
        // Разбиваем адрес по символу слеша
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        } else {
            $controllerName = "page";
        }

        // Определяем имя контроллера
        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";
        // Проверяем контроллер на сущеествование
        if (class_exists($this->controllerName)) {
            if (isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            } else {
                $methodName = 'index';
            }

            $this->methodName = "action" . ucfirst($methodName);

            if (method_exists($this->controllerName, $this->methodName)) {
                $controlllerInstance = new $this->controllerName();
                return call_user_func_array([$controlllerInstance, $this->methodName], []);
            } else {
                header("HTTP/1/.1 404 Not Found");
                header("Status: 404 Not Found");
                return call_user_func_array([new ErrorController(), "actionIndex"], []);
            }
        } else {
            header("HTTP/1/.1 404 Not Found");
            header("Status: 404 Not Found");
            return call_user_func_array([new ErrorController(), 'actionIndex'], []);
        }
        // Создаем экземпляр контроллера, если класс существует

        // Проверяем метод на существование

        // Вызываем метод, если он существует
    }
}