<?php
namespace Pretest\Controllers;

use Pretest\Models;

/**
 * EventController クラス
 * イベント一覧ページ、イベント詳細ページ、ランキングページの表示や、
 * ランキングに掲載する処理をモデルに依頼する役割を担う。
 * @author 0918nobita
 * @package Pretest\Controllers
 */

class EventController extends Controller
{
    use Models\Paging;

    public function __construct()
    {
        $this->model = new Models\EventModel();
        parent::__construct();
    }

    /**
     * Controller::display()をオーバーライドしている。
     * イベント一覧ページを表示する。
     */
    public function display()
    {
        $this->view = 'event.html.twig';
        list($present, $future, $past) = $this->model->getEvents();
        $this->assign(array(
            'present' => $present,
            'future' => $future,
            'past' => $past
        ));
        parent::display();
    }

    /**
     * イベント詳細ページを表示する。
     */
    public function detail()
    {
        $this->view = 'eventDetail.html.twig';
        list($category, $name, $first, $last, $quantity, $start, $end, $held) = $this->model->getEventInfo($_GET['id']);
        $this->assign(array(
            'category' => $category,
            'name' => $name,
            'first' => $first,
            'last' => $last,
            'quantity' => $quantity,
            'start' => $start,
            'end' => $end,
            'held' => $held
        ));
        parent::display();
    }

    /**
     * ランク付けを行う
     */
    public function rank()
    {
        $this->model->rank($_POST['nickname'], $_POST['score'], $_POST['category']);
        header("Location: ./?controller=event&action=ranking&category=" . $_POST['category']);
    }

    /**
     * ランキングページを表示する
     */
    public function ranking()
    {
        $this->view = 'ranking.html.twig';
        list($category, $name, $first, $last, $quantity, $start, $end, $held) = $this->model->getEventInfo($_GET['category']);
        $this->assign(array(
            'ranking' => $this->model->raking($category),
            'name' => $name,
            'first' => $first,
            'last' => $last,
            'quantity' => $quantity,
            'start' => $start,
            'end' => $end,
            'held' => $held
        ));
        parent::display();
    }
}
