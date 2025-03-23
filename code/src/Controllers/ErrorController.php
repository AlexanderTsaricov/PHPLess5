<?php
// Файл лежит в code/Controllers/PageController.php
namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;

class ErrorController
{
    public function actionIndex()
    {
        $render = new Render();
        return $render->errorRender();
    }
}