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
    protected $stylesheetPath = 'pretest.css';

    protected $validator; // 入力値検証クラスのインスタンスが代入される

    public function __construct()
    {
        $this->validator = new Models\Validator();
        $this->model = new Models\PretestModel();
        parent::__construct();
    }

    public function display()
    {
        list($first, $last) = $this->validator->checkRange($_POST['first'], $_POST['last'], $this->model->max);
        list($answerMethod, $method) = $this->validator->checkMethod($_POST['answer_method'], $_POST['method']);
        $order = $this->validator->checkOrder($_POST['order']);
        $quantity = $this->validator->checkQuantity($first, $last, $_POST['quantity'], $_POST['order']);
        $this->assign(array(
            'first' => $first,
            'last' => $last,
            'answer_method' => $answerMethod,
            'method' => $method,
            'quantity' => $quantity,
            'words' => $this->model->getWords(
                $first,
                $last,
                ($order == 'num') ? Models\PretestModel::NUM : Models\PretestModel::RND,
                ($order == 'rnd') ? $quantity : -1
            ),
        ));
        $_SESSION['setting'] = 'true';
        $_SESSION['first'] = $first;
        $_SESSION['last'] = $last;
        $_SESSION['answer_method'] = $answerMethod;
        $_SESSION['method'] = $method;
        $_SESSION['order'] = $order;
        $_SESSION['quantity'] = $quantity;
        parent::display();
    }
}
