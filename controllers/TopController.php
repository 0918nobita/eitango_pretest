<?php
namespace Pretest\Controllers;
use Pretest\Models\PretestModel;

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
    protected $stylesheetPath = 'top.css';

    public function __construct()
    {
        parent::__construct();
        $this->model = new PretestModel();
    }

    public function display()
    {
        $this->assign(array('max' => $this->model->max));
        if (isset($_SESSION['setting'])) {
            $this->assign(array(
                'first' => $_SESSION['first'],
                'last' => $_SESSION['last']
            ));
            switch ($_SESSION['answer_method']) {
                case 'touch':
                    $this->assign(array('touch_selected' => 'selected'));
                    break;
                case 'type':
                    $this->assign(array('type_selected' => 'selected'));
                    break;
            }
            switch ($_SESSION['method']) {
                case 'eitango-imi':
                    $this->assign(array('eitango_imi_selected' => 'selected'));
                    break;
                case 'imi-eitango':
                    $this->assign(array('imi_eitango_selected' => 'selected'));
                    break;
            }
            switch ($_SESSION['order']) {
                case 'num':
                    $this->assign(array('num_selected' => 'selected'));
                    break;
                case 'rnd':
                    $this->assign(array('rnd_selected' => 'selected'));
                    if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {
                        $this->assign(array('quantity' => $_SESSION['quantity']));
                    }
                    break;
            }
        }
        parent::display();
    }
}
