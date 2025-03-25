<?php

namespace Geekbrains\Application1\Domain\Models;
use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;

class User
{
    private ?string $userName;

    private ?string $userLastname;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

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

    public function __construct(string $name = null, string $lastname = null, int $birthday = null)
    {
        $this->userName = $name;
        $this->userLastname = $lastname;
        $this->userBirthday = $birthday;
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
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp']);
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


}