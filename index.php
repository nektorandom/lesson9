<?php

// мы используем сессию для хранения токена
// не забываем стартовать сессию в самом начале
session_start();

// подключаем файл с основными функциями
require 'vendor/autoload.php';

// получаем название контроллера из адресной строки
// http://localhost/index.php?action=message&method=add
// если там пусто - по умолчанию это будет 'home'
$action = isset($_GET['action']) ? strtolower($_GET['action']) . 'Controller' : 'AccountController';
$action = ucwords($action);
$method = isset($_GET['method']) ? $_GET['method'] : 'index';

// формируем название нужного файла контроллера
// в папке controllers должен быть файл php
// с названием, соответствующим пришедшему из адресной строки
$action_file = 'controllers/' . $action . '.php';

// проверяем есть ли такой файл и подключаем его
// иначе выводим шаблон с сообщением об ошибке
if (file_exists($action_file)) {
    require $action_file;
    $controller = new $action();
    $controller->$method();
} else {
    echo template('templates/error.php');
}
