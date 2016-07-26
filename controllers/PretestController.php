<?php
namespace Pretest\Controllers;

use Pretest\Models;

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

    protected $validator; // 入力値検証クラスのインスタンスが代入される

    public function __construct()
    {
        $this->validator = new Models\Validator();
        $this->model = new Models\PretestModel();
        parent::__construct();
    }

    public function display()
    {
        $this->validator->checkRange($_GET["first"], $_GET["last"], $this->model->max);
        parent::display();
    }
}
