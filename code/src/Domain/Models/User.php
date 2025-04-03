<?php

namespace Geekbrains\Application1\Domain\Models;
use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;
use DateTime;

class User
{
    private ?string $userName;

    private ?string $userLastname;
    private ?int $userBirthday;

    private ?int $userId;

    private ?string $login;

    private ?string $logtoken;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function getUserId(): int
    {
        return $this->userId;
    }

    private function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserLastname(string $userLastname): void
    {
        $this->userLastname = $userLastname;
    }
    public function getUserLastname(): ?string
    {
        return $this->userLastname;
    }

    public function getUserBirthday(): ?int
    {
        return $this->userBirthday;
    }

    public function getLogin()  :?string {
        return $this->login;
    }

    public function getLogtoken(): ?string {
        return $this->logtoken;
    }

    public function __construct(
        string $name = null, 
        string $lastname = null, 
        int $birthday = null, 
        int $userId = null, 
        string $login=null,
        string $logtoken = null)
    {
        $this->userName = $name;
        $this->userLastname = $lastname;
        $this->userBirthday = $birthday;
        $this->userId = $userId;
        $this->login = $login;
        $this->logtoken = $logtoken;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(?int $limit = null): array|false
    {
        $sql = "SELECT * FROM users";

        if (isset($limit) && $limit > 0) {
            $sql .= " WHERE id_user > " . (int)$limit;
        }

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();

        $result = $handler->fetchAll();

        $users = [];

        foreach ($result as $item) {
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'], $item['id_user'], $item['login']);
            $users[] = $user;
        }

        return $users;
    }

    public static function validateRequestData(): bool
    {
        $result = true;
        if (
            !(
                isset($_POST['name']) && !empty($_POST['name']) &&
                isset($_POST['lastname']) && !empty($_POST['lastname']) &&
                isset($_POST['birthday']) && !empty($_POST['birthday'])
            )
        ) {
            $result = false;
        }

        if (!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])) {
            $result = false;
        }

        if (!preg_match('/^[A-Za-zА-Яа-яЁё]+$/u', $_POST['name'])) {
            $result = false;
        }
        if (!preg_match('/^[A-Za-zА-Яа-яЁё]+$/u', $_POST['lastname'])) {
            $result = false;
        }

        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $result = false;
        }

        return $result;

    }

    public function setParamsFromRequestData(): void
    {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastname = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']);
    }

    public function saveToStorage(): void
    {
        $storage = new Storage();
        $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp) VALUES (:user_name, :user_lastname, :user_birthday)";
        $handler = $storage->get()->prepare($sql);
        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastname,
            'user_birthday' => $this->userBirthday
        ]);
    }

    public static function validateUpdateData(): bool
    {
        if (isset($_POST['id_user']) && !empty($_POST['id_user'])) {

            $users = User::getAllUsersFromStorage();
            foreach ($users as $user) {
                if ($user->getUserId() == (int) $_POST['id_user']) {
                    $result = true;
                    if (!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])) {
                        $result = false;
                    }

                    if (!preg_match('/^[A-Za-zА-Яа-яЁё]+$/u', $_POST['name'])) {
                        $result = false;
                    }
                    if (!preg_match('/^[A-Za-zА-Яа-яЁё]+$/u', $_POST['lastname'])) {
                        $result = false;
                    }

                    return $result;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }

    }

    public static function validateDeleteData(): bool
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $users = User::getAllUsersFromStorage();
            foreach ($users as $user) {
                if ($user->getUserId() == (int) $_GET['id']) {
                    return true;
                }
            }
        } else {
            return false;
        }
        return false;
    }

    public function updateUser(): void
    {
        $storage = new Storage();
        $userName = null;
        $userLastname = null;
        $userBirthday = null;
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $userName = $_POST['name'];
            $sql = 'UPDATE users set user_name=:user_name where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $handler->execute(['id_user' => $_POST['id_user'], 'user_name' => $userName]);
        }
        if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
            $userLastname = $_POST['lastname'];
            $sql = 'UPDATE users set user_lastname=:user_lastname where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $handler->execute(['id_user' => $_POST['id_user'], 'user_lastname' => $userLastname]);
        }
        if (isset($_POST['birthday']) && !empty($_POST['birthday'])) {
            $userBirthday = $_POST['birthday'];
            $sql = 'UPDATE users set user_birthday_timestamp=:user_birthday_timestamp where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $dateTime = DateTime::createFromFormat('d-m-Y', $userBirthday);
            $timestamp = $dateTime->getTimestamp();
            $handler->execute(['id_user' => $_POST['id_user'], 'user_birthday_timestamp' => $timestamp]);
        }
        $this->setUserId($_POST['id_user']);
    }

    public function deleteUser(): void
    {
        $storage = new Storage();
        $userId = (int) $_GET['id'];
        $sql = 'DELETE FROM users WHERE id_user=:userId';
        $handler = $storage->get()->prepare($sql);
        $handler->execute(['userId' => $userId]);
        $this->setUserId($_GET['id']);
    }

    public static function getUserById(int $id): ?User
    {
        $storage = new Storage();
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $handler = $storage->get()->prepare($sql);
        $handler->execute(["id" => $id]);
        $result = $handler->fetchAll();
        if (count($result) > 0) {
            return new User(
                $result[0]['user_name'], 
                $result[0]['user_lastname'], 
                $result[0]['user_birthday_timestamp'], 
                $result[0]['id_user']
            );
        } else {
            throw new \Exception('Пользователя с id ' . $id . ' не существует');
        }
    }


    public static function setLogTokenInBD($login, $logToken) {
        $someUser = new User();
        $users = $someUser->getAllUsersFromStorage();

        foreach ($users as $user) {
            if ($user->getLogin() == $login) {
                $userId = $user->getUserId();
                $storage = new Storage();

                $sql = 'UPDATE users set logtoken=:logtoken WHERE id_user=:userID';
                $handler = $storage->get()->prepare($sql);
                $handler->execute(["userID" => $userId, "logtoken" => $logToken]);

            }
        }
    }

    public static function getUserByLogToken($logToken): User {
        $storage = new Storage();
        $sql = "SELECT * FROM users WHERE logtoken=:logtoken";
        $handler = $storage->get()->prepare($sql);
        $handler->execute(["logtoken"=> $logToken]);
        $result = $handler->fetchAll();
        return new User(
            $result[0]["user_name"], 
            $result[0]['user_lastname'], 
            $result[0]['user_birthday_timestamp'],
        $result[0]['id_user'],
        $result[0]['login'],
        $result[0]['logtoken']);
    }

    /**
     * Summary of getUserDataAsArray
     * Returns users like are array
     * @return array{id: int|null, userbirthday: string, userlastname: string|null, username: string|null}
     */
    public function getUserDataAsArray(): array {
        $userArray = [
            'id' => $this->userId,
            'username' => $this->userName,
            'userlastname' => $this->userLastname,
            'userbirthday' => date('d-m-Y', $this->userBirthday)
        ];
        return $userArray;
    }

}