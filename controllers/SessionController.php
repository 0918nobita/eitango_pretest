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

    // 不正解だった問題を復習するモードの復習ページで削除を選択された問題の番号の配列を
    // POSTで受け取り、セッションから削除する
    public function deleteIncorrectProblems() {
        $this->model->deleteIncorrectProblems();
    }

    // 選択して保存した問題を復習するモードの復習ページで削除を選択された問題の番号の配列を
    // POSTで受け取り、セッションから削除する
    public function deleteSelectedProblems() {
        $this->model->deleteSelectedProblems();
    }

    // 不正解だった問題の番号をセッションに保存する
    public function saveIncorrectProblems() {
        $this->model->saveIncorrectProblems();
    }

    // 選択して保存ボタンを押してPOST送信された問題番号の配列をセッションに保存する
    public function saveSelectedProblems() {
        $this->model->saveSelectedProblems();
    }
}
