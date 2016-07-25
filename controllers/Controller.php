<?php
namespace Pretest\Controllers;

abstract class Controller
{
    protected $view;
    protected $stylesheetPath;
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $this->twig = new \Twig_Environment($loader);
    }

    public function display()
    {
        $template = $this->twig->loadTemplate('base.html.twig');
        $data = array(
            'title' => SITE_NAME,
            'site_description' => SITE_DESCRIPTION,
            'content' => $this->view,
            'stylesheet_file_path' => $this->stylesheetPath
        );
        echo $template->render($data);
    }
}
