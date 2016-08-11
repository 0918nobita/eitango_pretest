<?php
namespace Pretest\Controllers;

use Pretest\Models;

/**
 * PretestController クラス
 * プレテストページを表示する際に呼び出されるコントローラで、
 * テンプレートファイルとスタイルシートファイルを指定するフィールドを上書きする。
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

    /**
     * Controller::display()をオーバーライドしています。
     * プレテストページを表示する前に、設定画面で入力された内容の検証と
     * テンプレートファイルへの(Validatorクラスのメソッドが返した)単なる値の埋め込みを行います。
     */
    public function display()
    {
        // 入力値検証を行います。check-メソッドはどれも、検証済みの単なる値を返します。
        list($first, $last) = $this->validator->checkRange($_POST['first'], $_POST['last'], $this->model->max);
        list($answerMethod, $method) = $this->validator->checkMethod($_POST['answer_method'], $_POST['method']);
        $order = $this->validator->checkOrder($_POST['order']);
        $quantity = $this->validator->checkQuantity($first, $last, $_POST['quantity'], $_POST['order']);

        // テンプレートファイルに埋め込むデータを指定します。
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
            )
        ));

        // イベントに参加している場合は、イベント識別番号(category)も埋め込みます。
        if (isset($_POST['event'])) $this->assign(array(
            'event' => 'true',
            'category' => $_POST['category']
        ));

        // 入力値をセッションに保存することで、設定画面での操作時間を短縮します。
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
