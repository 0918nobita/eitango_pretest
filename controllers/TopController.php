<?php
namespace Pretest\Controllers;

class TopController extends Controller
{
    protected $view = 'top.html.twig';
    protected $stylesheetPath = './views/style.css';

    public function display() {
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
