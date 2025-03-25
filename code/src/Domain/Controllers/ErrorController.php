<?php
// Файл лежит в code/Controllers/PageController.php
namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Render;

class ErrorController
{
    public function actionIndex()
    {
        $render = new Render();
        return $render->errorRender();
    }
}