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
                'page_link_incorrect' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['incorrect'])) ? count($_SESSION['incorrect']) : 0, 50
                ),
                'incorrect' => array_splice(
                    $this->model->getSelectedWords((isset($_SESSION['incorrect'])) ? $_SESSION['incorrect'] : array()),
                    $this->getFrom(), $this->getTo()
                )
            ));
        } else {
            $this->assign(array(
                'mode' => 'selected',
                'page_link_selected' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    (isset($_SESSION['selected'])) ? count($_SESSION['selected']) : 0, 50
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
