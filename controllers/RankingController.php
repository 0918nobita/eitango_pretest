<?php
namespace Pretest\Controllers;
use Pretest\Models;

/**
 * RankingController クラス
 * プレテストページからのPOST送信を受け取って、
 * ランキングにニックネームとスコアを記録する
 * @access public
 * @author 0918nobita
 * @package Pretest\Controllers
 */

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
