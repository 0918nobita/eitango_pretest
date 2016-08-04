<?php
namespace Pretest\Controllers;
use Pretest\Models;

class RankingController extends Controller {
    protected $view = "ranking.html.twig";
    protected $stylesheetPath = "./views/css/ranking.css";
    
    public function __construct()
    {
        parent::_construct();
        $this->model = new RankingModel();
    }
    
    public function display()
    {
        parent::display();
    }
}
