<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController
{
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
}