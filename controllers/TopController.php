<?php
namespace Pretest\Controllers;

/**
 * TopController クラス
 * トップページを表示する際に呼び出されるコントローラで、
 * テンプレートファイルとスタイルシートファイルを指定するフィールドを上書きする。
 * @access public
 * @author 0918nobita
 * @package Pretest\Controllers
 */
class TopController extends Controller
{
    protected $view = 'top.html.twig';
    protected $stylesheetPath = './views/style.css';
}
