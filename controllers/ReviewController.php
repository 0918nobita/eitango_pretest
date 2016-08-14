<?php
namespace Pretest\Controllers;
use Pretest\Models;

class ReviewController extends Controller
{
    use Models\Paging;

    protected $view = 'review.html.twig';
}
