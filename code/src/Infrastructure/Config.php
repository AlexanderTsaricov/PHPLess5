<?php

namespace Geekbrains\Application1\Infrastructure;

class Config
{
    private string $defaultConfigFile = "/src/config/config.ini";

    private array $applicationConfiguration = [];

    public function __construct()
    {
        $adress = $_SERVER['DOCUMENT_ROOT'] . $this->defaultConfigFile;

        if (file_exists($adress) && is_readable($adress)) {
            $this->applicationConfiguration = parse_ini_file($adress, true);
        } else {
            throw new \Exception('Файл конфигурации не найден');
        }
    }

    public function get(): array
    {
        return $this->applicationConfiguration;
    }
}