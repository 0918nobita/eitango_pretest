<?php
namespace Pretest\Controllers;
use Pretest\Models;

class ReviewController extends Controller
{
    use Models\Paging;

    protected $view = 'review.html.twig';

    public function display()
    {
        $this->pagingInit(count($_SESSION['incorrect']) + count($_SESSION['selected']), 50);
        $this->assign(array(
            'page_link' => $this->addPageLink(
                (isset($_GET['page'])) ? $_GET['page'] : 1
            )
        ));
        parent::display();
    }
}
