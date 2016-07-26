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
            case 'pretest':
                $controllerInstance = new Controllers\PretestController();
                break;
            case 'error':
                $controllerInstance = new Controllers\ErrorController();
                break;
            default:
                $controllerInstance = new Controllers\TopController();
                break;
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'display';
        $controllerInstance->$action();
    }
}
