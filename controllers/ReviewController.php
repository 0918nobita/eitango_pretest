<?php
namespace Pretest\Controllers;
use Pretest\Models;

class ReviewController extends Controller
{
    use Models\Paging;

    protected $view = 'review.html.twig';

    public function display()
    {
        $this->assign(array(
            'incorrect' => $_SESSION['incorrect'],
            'selected' => $_SESSION['selected'],
            'page_link_selected' => $this->addPageLink(
                (isset($_GET['page'])) ? $_GET['page'] : 1,
                count($_SESSION['selected']), 50
            ),
            'page_link_incorrect' => $this->addPageLink(
                (isset($_GET['page'])) ? $_GET['page'] : 1,
                count($_SESSION['incorrect']), 50
            )
        ));
        parent::display();
    }
}
