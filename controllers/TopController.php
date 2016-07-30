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
    protected $stylesheetPath = './views/css/top.css';

    public function __construct()
    {
        parent::__construct();
        $this->model = new PretestModel();
    }

    public function display()
    {
        $this->data = array_merge($this->data, array("max" => $this->model->max));
        parent::display();
    }
}
