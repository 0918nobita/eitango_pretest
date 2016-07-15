<?php
namespace Pretest;

use Pretest\Controllers\TopController;

class Dispatcher
{
    public function dispatch()
    {
        $controller = '';
        if (isset($_GET['controller'])) $controller = $_GET['controller'];
        switch ($controller) {
            case 'pretest':
                $controllerInstance = new Controllers\PretestController();
                break;
            default:
                $controllerInstance = new Controllers\TopController();
                break;
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'display';
        $controllerInstance->$action();
    }
}
