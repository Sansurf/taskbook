<?php
/**
 * Точка входа
 */

// загрузчик классов
require '../vendor/autoload.php';

// определяет метод класса
$action = 'action';
$action .= (isset($_GET['action'])) ? $_GET['action'] : 'Index';

// выбор класса
if (isset($_GET['controller'])) {
    $controllerName = '\app\controllers\\' . $_GET['controller'] . 'Controller';
    $controller = new $controllerName;
} else {
    $controller = new app\controllers\SiteController;
}

$controller->$action();
