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
        $this->data = array_merge($this->data, array("first" => $_POST["first"], "last" => $_POST["last"]));
        if ($_POST["method"] == "eitango-imi") {
            $this->data = array_merge($this->data, array("method" => "eitango-imi"));
        } else {
            $this->data = array_merge($this->data, array("method" => "imi-eitango"));
        }
        if ($_POST["order"] == "num") {
            $this->data = array_merge($this->data, array("words" => $this->model->getWords($_POST["first"], $_POST["last"], Models\PretestModel::NUM)));
        } else {
            $this->data = array_merge($this->data, array("words" => $this->model->getWords($_POST["first"], $_POST["last"], Models\PretestModel::RND, $_POST["quantity"])));
        }
        parent::display();
    }
}
