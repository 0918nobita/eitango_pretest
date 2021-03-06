<?php
namespace Pretest;

/**
 * Dispatcher クラス
 * GETパラメータをもとに呼び出すコントローラとアクションを決定し、コントローラクラスからインスタンスを生成してアクションを呼び出す。
 * @access public
 * @author 0918nobita
 * @package Pretest
 */
class Dispatcher
{
    public function dispatch()
    {
        $controller = '';
        if (isset($_GET['controller'])) $controller = $_GET['controller'];
        switch ($controller) {
            case 'error':
                $controllerInstance = new Controllers\ErrorController();
                break;
            case 'event':
                $controllerInstance = new Controllers\EventController();
                break;
            case 'pretest':
                $controllerInstance = new Controllers\PretestController();
                break;
            case 'review':
                $controllerInstance = new Controllers\ReviewController();
                break;
            case 'session':
                $controllerInstance = new Controllers\SessionController();
                break;
            default:
                $controllerInstance = new Controllers\TopController();
                break;
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'display';
        $controllerInstance->$action();
    }
}
