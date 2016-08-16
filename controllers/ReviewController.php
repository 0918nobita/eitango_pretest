<?php
namespace Pretest\Controllers;
use Pretest\Models;

class ReviewController extends Controller
{
    use Models\Paging;

    protected $view = 'review.html.twig';

    public function __construct()
    {
        $this->model = new Models\ReviewModel();
        parent::__construct();
    }

    public function display()
    {
        if (isset($_GET['mode']) && ($_GET['mode'] == "incorrect")) {
            $this->assign(array(
                'mode' => 'incorrect',
                'incorrect' => $this->model->getSelectedWords((isset($_SESSION['incorrect'])) ? $_SESSION['incorrect'] : array()),
                'page_link_incorrect' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['incorrect'])) ? count($_SESSION['incorrect']) : 0, 50
                )
            ));
        } else {
            $this->assign(array(
                'mode' => 'selected',
                'selected' => $this->model->getSelectedWords((isset($_SESSION['selected'])) ? $_SESSION['selected'] : array()),
                'page_link_selected' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['selected'])) ? count($_SESSION['selected']) : 0, 50
                )
            ));
        }
        parent::display();
    }
}
