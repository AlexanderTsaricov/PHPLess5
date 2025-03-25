<?php

namespace Geekbrains\Application1\Domain\Models;
use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;
use LDAP\Result;

class User
{
    private ?string $userName;

    private ?string $userLastname;
    private ?int $userBirthday;

    private ?int $userId;

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

    public function getUserBirthday(): int
    {
        return $this->userBirthday;
    }

    public function __construct(string $name = null, string $lastname = null, int $birthday = null, int $userId = null)
    {
        $this->userName = $name;
        $this->userLastname = $lastname;
        $this->userBirthday = $birthday;
        $this->userId = $userId;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array|false
    {
        $sql = "SELECT * FROM users";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();

        $result = $handler->fetchAll();

        $users = [];

        foreach ($result as $item) {
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'], $item['id_user']);
            $users[] = $user;
        }

        return $users;
        /*
        $adress = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;

        if (file_exists($adress) && is_readable($adress)) {
            $file = fopen($adress, "r");

            $users = [];

            while (!feof($file)) {
                $userStrig = fgets($file);
                $userArray = explode(",", $userStrig);

                $user = new User(
                    $userArray[0]
                );
                $user->setBirthdayFromString($userArray[1]);
                $users[] = $user;
            }

            fclose($file);

            return $users;
        } else {
            return false;
        }
            */
    }

    /*
    public static function save(User $user): bool
    {

        $adress = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;
        $myFormatBirthday = date("d-m-Y", $user->getUserBirthday());

        if (file_exists($adress) && is_writable($adress)) {
            $file = fopen($adress, "a");

            fwrite($file, "\n" . $user->getUserName() . "," . $myFormatBirthday);

            fclose($file);

            return true;
        } else {
            return false;
        }
    }
        */

    public static function validateRequestData(): bool
    {
        if (
            isset($_GET['name']) && !empty($_GET['name']) &&
            isset($_GET['lastname']) && !empty($_GET['lastname']) &&
            isset($_GET['birthday']) && !empty($_GET['birthday'])
        ) {
            return true;
        } else {
            return false;
        }

    }

    public function setParamsFromRequestData(): void
    {
        $this->userName = $_GET['name'];
        $this->userLastname = $_GET['lastname'];
        $this->setBirthdayFromString($_GET['birthday']);
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
        $result = false;
        if (isset($_GET['id']) && !empty($_GET['id']) && substr_count($_SERVER['QUERY_STRING'], '&') > 0) {
            $params = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($params as $param) {
                $separateParam = explode('=', $param);
                if (count($separateParam) == 2) {
                    switch ($separateParam[0]) {
                        case 'id':
                        case 'name':
                        case 'lastname':
                        case 'birthday':
                            break;
                        default:
                            return false;
                    }
                } else {
                    return false;
                }
            }
            $users = User::getAllUsersFromStorage();
            foreach ($users as $user) {
                if ($user->getUserId() == (int) $_GET['id']) {
                    return true;
                }
            }
        }
        return $result;
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
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $userName = $_GET['name'];
            $sql = 'UPDATE users set user_name=:user_name where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $handler->execute(['id_user' => $_GET['id'], 'user_name' => $userName]);
        }
        if (isset($_GET['lastname']) && !empty($_GET['lastname'])) {
            $userLastname = $_GET['lastname'];
            $sql = 'UPDATE users set user_lastname=:user_lastname where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $handler->execute(['id_user' => $_GET['id'], 'user_lastname' => $userLastname]);
        }
        if (isset($_GET['birthday']) && !empty($_GET['birthday'])) {
            $userBirthday = $_GET['birthday'];
            $sql = 'UPDATE users set user_birthday_timestamp=:user_birthday_timestamp where id_user=:id_user';
            $handler = $storage->get()->prepare($sql);
            $handler->execute(['id_user' => $_GET['id'], 'user_birthday_timestamp' => (int) $userBirthday]);
        }
        $this->setUserId($_GET['id']);
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


}