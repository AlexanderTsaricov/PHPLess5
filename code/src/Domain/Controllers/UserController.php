<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;
use Geekbrains\Application1\Domain\Controllers\AbstractController;



class UserController extends AbstractController
{

    protected array $actionsPermissions = [
        'actionHash' => ['admin', 'manager'],
        'actionSave' => ['admin']
    ];

    public function actionIndex()
    {
        $users = User::getAllUsersFromStorage();
        $render = new Render();
        if (count($users) == 0) {
            return $render->renderPage(
                'user-empty.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => 'Список пуст или не найден'
                ],
                "/user-empty/user-empty.css"
            );
        } else {
            return $render->renderPage(
                'user-index.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ],
                "/user-index/user-index.css"
            );
        }
    }

    public function actionSave(): string
    {
        if (User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                "user-created.tpl",
                [
                    "title" => "Пользователь создан",
                    "message" => "Создан пользователь  " . $user->getUserName() . " " . $user->getUserLastname()
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionUpdatingUser(): string
    {
        $render = new Render();
        $userId = $_GET['id'];
        $user = User::getUserById(intval($userId));
        $formatedBirthday = date('d-m-Y', $user->getUserBirthday());

        return $render->renderPage(
            "updateUserForm.tpl",
            [
                "title" => "Пользователь обновлен",
                "userId" => $userId,
                "user_firstname" => $user->getUserName(),
                "user_lastname" => $user->getUserLastname(),
                "user_birthday" => $formatedBirthday,
            ]
        );
    }

    public function actionUpdate()
    {
        $user = new User();
        $render = new Render();
        if (User::validateUpdateData()) {

            $user->updateUser();
            return $render->renderPage(
                "user-created.tpl",
                [
                    "title" => "Пользователь обновлен",
                    "message" => "Обновлен пользователь с ID " . $user->getUserId()
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны или не найден пользователь с такми ID");
        }
    }

    public function actionDelete(): string
    {

        $user = new User();
        $render = new Render();
        if (User::validateDeleteData()) {
            $user->deleteUser();
            return $render->renderPage(
                "user-created.tpl",
                [
                    "title" => "Пользователь удален",
                    "message" => "Удален пользователь с ID " . $user->getUserId()
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны или не найден пользователь с такми ID");
        }
    }

    /**
     * Summary of actionEdit
     * Generation form page
     * @return void
     */
    public function actionEdit(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'user-form.tpl',
            [
                'title' => 'Форма создания пользователя',
            ]
        );
    }

    public function actionHash(): string
    {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionEnter(): string {
        if (isset($_COOKIE['mysite'])) {
            $browserLogToken = $_COOKIE['mysite'];
            $user = User::getUserByLogToken($browserLogToken);
            if ($user ==! null) {
                $_SESSION['user_name'] = $user->getUserName();
                $_SESSION['user_lastname'] = $user->getUserLastname();
                $_SESSION['id_user'] = $user->getUserId();
                header('Location: /');
                return "";
            } else {
                $this->actionAuth();
            }
        } else {
            $this->actionAuth();
        }
    }

    public function actionAuth(): string
    {
        $render = new Render();
        return $render->renderPageWithForm(
            'user-auth.tpl',
            [
                'title' => 'Форма логина'
            ]
        );
    }

    private function saveMy(string $login): void {
        $logToken = random_bytes(10);
        setcookie('mysite', $logToken, time() + 10 * 365 * 24 * 60 * 60, "/");
        User::setLogTokenInBD($login, $logToken);
    }

    public function actionLogin(): string
    {
        $result = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }

        if (!$result) {
            $render = new Render();
            return $render->renderPageWithForm(
                'user-auth.tpl',
                [
                    'auth-error' => 'Неверные логин или пароль'
                ]
            );
        } else {
            if ($_POST['saveMy']) {
                $this->saveMy($_POST['login']);
            }
            header('Location: /');
            return "";
        }
    }

    public function actionLogout(): string
    {
        session_destroy();
        setcookie('mysite', '', time() - 3600, '/');
        header('Location: /');
        return '';
    }
}