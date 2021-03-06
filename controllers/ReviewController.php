<?php
namespace Pretest\Controllers;

use Pretest\Models;

/**
 * ReviewController クラス
 * 復習ページを表示する際に呼び出されるコントローラで、
 * ページング処理を実装している。(1ページあたり20件出力)
 * @author 0918nobita
 * @package Pretest\Controllers
 */

class ReviewController extends Controller
{
    use Models\Paging;  // Pagingトレイトを取り込む

    protected $view = 'review.html.twig';

    public function __construct()
    {
        $this->model = new Models\ReviewModel();
        parent::__construct();
    }

    public function display()
    {
        if (isset($_GET['mode']) && ($_GET['mode'] == "incorrect")) {
            // 入力して正誤判定する設定のプレテストで不正解だった問題を一覧表示するモード
            $this->assign(array(
                'mode' => 'incorrect',
                'page_link_incorrect' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['incorrect'])) ? count($_SESSION['incorrect']) : 0, 20
                ),
                'incorrect' => array_splice(
                    $this->model->getSelectedWords((isset($_SESSION['incorrect'])) ? $_SESSION['incorrect'] : array()),
                    $this->getFrom(), $this->getTo()
                )
            ));
        } else {
            // 選択して保存した問題を一覧表示するモード
            $this->assign(array(
                'mode' => 'selected',
                'page_link_selected' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['selected'])) ? count($_SESSION['selected']) : 0, 20
                ),
                'selected' => array_splice(
                    $this->model->getSelectedWords((isset($_SESSION['selected'])) ? $_SESSION['selected'] : array()),
                    $this->getFrom(), $this->getTo()
                )
            ));
        }
        parent::display();
    }
}
