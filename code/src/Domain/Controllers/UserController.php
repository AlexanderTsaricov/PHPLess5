<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;

class UserController
{
    /*
    public function actionSave()
    {
        $name = $_GET['name'] ?? '';
        $birthday = $_GET['birthday'] ?? '';
        $intBurthday = strtotime($birthday);
        $user = new User($name, $intBurthday);
        User::save($user);
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
        */

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
}