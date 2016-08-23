<?php
namespace Pretest\Controllers;

use Pretest\Models;

/**
 * SessionController クラス
 * プレテストページの「選択した問題を保存する」ボタンを押されたとき、
 * または答えを入力して正誤確認するモードで、すべての問題を解き終えたときに呼び出される、
 * セッション管理を担っているクラス。
 * @author 0918nobita
 * @package Pretest\Controllers
 */

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
