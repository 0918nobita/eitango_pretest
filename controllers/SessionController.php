<?php
namespace Pretest\Controllers;
use Pretest\Models;

class SessionController
{
    public function __construct()
    {
        $this->model = new Models\Session();
    }

    public function saveIncorrectProblems() {
        $this->model->set("incorrect", json_decode($_POST["incorrect"]));
    }
}
