<?php
namespace Pretest\Controllers;

abstract class Controller
{
    protected $view;
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $this->twig = new \Twig_Environment($loader);
        $template = $this->twig->loadTemplate('top.html.twig');
        $data = array(
            'title' => '英単語プレテスト',
            'message'  => 'ようこそ！'
        );
        echo $template->render($data);
    }

    public function display()
    {
    }
}
