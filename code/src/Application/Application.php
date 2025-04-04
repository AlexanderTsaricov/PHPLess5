<?php
namespace Geekbrains\Application1\Application;

use Geekbrains\Application1\Domain\Controllers\AbstractController;
use Geekbrains\Application1\Domain\Controllers\ErrorController;
use Geekbrains\Application1\Infrastructure\Config;
use Geekbrains\Application1\Infrastructure\Storage;
use Geekbrains\Application1\Application\Auth;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

class Application
{
    private const APP_NAMESPACE = "Geekbrains\Application1\Domain\Controllers\\";
    private string $controllerName;
    private string $methodName;

    public static Config $config;

    public static Storage $storage;

    public static Auth $auth;

    public static Logger $logger;

    public function __construct()
    {
        Application::$config = new Config();
        Application::$storage = new Storage();
        Application::$auth = new Auth();
        Application::$logger = new Logger('application_logger');
        Application::$logger->pushHandler(new StreamHandler(
            $_SERVER['DOCUMENT_ROOT'] ."/../log/" . Application::$config->get()['log']['LOGS_FILE'] . "-" . date('Y-m-d') . ".log", Level::Debug
        ));

        Application::$logger->pushHandler(new FirePHPHandler());

    }

    public function run()
    {
        // Для начала сессии вызывам эту функцию
        session_start();

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

                if ($controlllerInstance instanceof AbstractController) {
                    if ($this->checkAccesToMethod($controlllerInstance, $this->methodName)) {
                        $userRoles = $controlllerInstance->getUserRoles();
                        $role = in_array('admin', $userRoles) ? 'admin' : 'guest';
                        return call_user_func_array(
                            [$controlllerInstance, $this->methodName],
                            [$role]
                        );
                    } else {
                        return 'Нет доступа к методу' . " " . $methodName . " в " . $controllerName;
                    }
                } else {
                    return call_user_func_array([$controlllerInstance, $this->methodName], []);
                }

            } else {
                $logMessage = "Метод " . $this->methodName . " не сущестувует в контроллере " . $this->controllerName . " | ";
                $logMessage .= "Попытка вызова адреса " . $_SERVER['REQUEST_URI'];
                Application::$logger->error($logMessage);
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

    private function checkAccesToMethod(AbstractController $controlllerInstance, string $methodName): bool
    {
        $userRoles = $controlllerInstance->getUserRoles();


        $rules = $controlllerInstance->getActionPermissions($methodName);
        $isAllowed = false;
        if (!empty($rules)) {
            foreach ($rules as $rolePermission) {
                if (in_array($rolePermission, $userRoles)) {
                    $isAllowed = true;
                    break;
                }
            }
        } else {
            $isAllowed = true;
        }

        return $isAllowed;
    }
}