<?php

namespace Geekbrains\Application1\Models;

class User
{
    private string $userName;
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

    public function getUserBirthday(): int
    {
        return $this->userBirthday;
    }

    public function __construct(string $userName, int $userBirthday = null)
    {
        $this->userName = $userName;
        $this->userBirthday = $userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array|false
    {
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
    }

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


}