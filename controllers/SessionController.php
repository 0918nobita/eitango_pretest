<?php
namespace Pretest\Controllers;
use Pretest\Models;

class SessionController
{
    public function __construct()
    {
        $this->model = new Models\Session();
    }

    public function deleteIncorrectProblems() {
        $this->model->deleteIncorrectProblems();
    }

    public function deleteSelectedProblems() {
        $this->model->deleteSelectedProblems();
    }

    public function saveIncorrectProblems() {
        $this->model->saveIncorrectProblems();
    }

    public function saveSelectedProblems() {
        $this->model->saveSelectedProblems();
    }
}
