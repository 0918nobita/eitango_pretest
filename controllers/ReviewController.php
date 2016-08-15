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
                'incorrect' => $_SESSION['incorrect'],
                'page_link_incorrect' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    count($_SESSION['incorrect']), 50
                )
            ));
        } else {
            $this->assign(array(
                'mode' => 'selected',
                'selected' => $_SESSION['selected'],
                'page_link_selected' => $this->addPageLink(
                    (isset($_GET['page'])) ? $_GET['page'] : 1,
                    count($_SESSION['selected']), 50
                )
            ));
        }
        parent::display();
    }
}
