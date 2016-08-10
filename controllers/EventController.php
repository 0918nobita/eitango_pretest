<?php
namespace Pretest\Controllers;

use Pretest\Models;

class EventController extends Controller
{
    public function __construct()
    {
        $this->model = new Models\EventModel();
        parent::__construct();
    }

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

    public function rank()
    {
        $this->model->rank($_POST['nickname'], $_POST['score'], $_POST['category']);
        header("Location: ./?controller=event&action=ranking");
    }

    public function ranking()
    {
        $this->view = 'ranking.html.twig';
        parent::display();
    }
}
