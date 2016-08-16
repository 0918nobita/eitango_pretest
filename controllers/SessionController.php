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
        $this->model->saveIncorrectProblems();
    }

    public function saveSelectedProblems() {
        $this->model->saveSelectedProblems();
    }
}
