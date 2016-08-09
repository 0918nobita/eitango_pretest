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
}
