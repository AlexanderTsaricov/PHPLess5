<?php
require_once ('../vendor/autoload.php');
$memory_start = memory_get_usage();

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Application;

try {
    $app = new Application();
    echo $app->run();
} catch (Exception $e) {
    $render = new Render();
    echo $render->renderExeptionPage($e);
}

$memory_end = memory_get_usage();

echo "<h4>Потреблено " . ($memory_end - $memory_start)/1024/1024 . " Мбайт памяти</h4>";