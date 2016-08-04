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
 */

class PretestController extends Controller
{
    protected $view = 'pretest.html.twig';
    protected $stylesheetPath = "./views/css/pretest.css";

    protected $validator; // 入力値検証クラスのインスタンスが代入される

    public function __construct()
    {
        $this->validator = new Models\Validator();
        $this->model = new Models\PretestModel();
        parent::__construct();
    }

    public function display()
    {
        $this->validator->checkRange($_POST["first"], $_POST["last"], $this->model->max);
        $this->assign(array(
            "first" => $_POST["first"],
            "last" => $_POST["last"],
            "method" => ($_POST["method"] == "eitango-imi") ? "eitango-imi" : "imi-eitango",
            "words" => $this->model->getWords(
                $_POST["first"],
                $_POST["last"],
                ($_POST["order"] == "num") ? Models\PretestModel::NUM : Models\PretestModel::RND,
                ($_POST["order"] == "rnd") ? $_POST["quantity"] : -1
            ),
        ));
        $_SESSION["setting"] = "true";
        $_SESSION["first"] = $_POST["first"];
        $_SESSION["last"] = $_POST["last"];
        $_SESSION["display"] = $_POST["display"];
        $_SESSION["method"] = $_POST["method"];
        $_SESSION["order"] = $_POST["order"];
        $_SESSION["quantity"] = $_POST["quantity"];
        parent::display();
    }
}
