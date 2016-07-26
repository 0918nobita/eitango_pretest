<?php
namespace Pretest\Controllers;

/**
 * PretestController クラス
 * プレテストページを表示する際に呼び出されるコントローラで、
 * テンプレートファイルとスタイルシートファイルを指定するフィールドを上書きする。
 * @access public
 * @author 0918nobita
 * @package Pretest\Controllers
 * @todo データベースと英単語データを受送信するPretestModelクラスから受け取ったデータをビューに渡す処理が実装できていない
 */
class PretestController extends Controller
{
    protected $view = 'pretest.html.twig';
    protected $stylesheetPath = "./views/pretest.css";
}
