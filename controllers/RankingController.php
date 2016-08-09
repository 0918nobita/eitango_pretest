<?php
namespace Pretest\Controllers;

/**
 * RankingController クラス
 * プレテストページからのPOST送信を受け取って、
 * ランキングにニックネームとスコアを記録する
 * @access public
 * @author 0918nobita
 * @package Pretest\Controllers
 */

class RankingController extends Controller {
    protected $view = 'ranking.html.twig';
    
    public function display()
    {
        parent::display();
    }
}
