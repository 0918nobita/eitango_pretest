<?php
namespace Pretest\Controllers;

abstract class Controller
{
    protected $view = 'top.html.twig';
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $this->twig = new \Twig_Environment($loader);
        $template = $this->twig->loadTemplate('base.html.twig');
        $data = array(
            'title' => SITE_NAME,
            'site_description' => SITE_DESCRIPTION,
            'content' => $this->view
        );
        echo $template->render($data);
    }

    public function display()
    {
    }
}
