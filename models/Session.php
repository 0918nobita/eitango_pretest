<?php
namespace Pretest\Models;

/**
 * Session クラス
 * セッション管理を担当するクラス。
 * @author 0918nobita
 * @package Pretest\Models
 */

class Session
{
    /**
     * セッションにデータを保存する。
     * @param $key string キー
     * @param $value mixed
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * 指定したキーに対応する値を返す。
     * @param $key string キー
     * @return mixed 対応する値
     */
    public static function get($key) {
        return $_SESSION[$key];
    }

    /**
     * セッションを全消去する。
     */
    public static function destroy() {
        session_destroy();
    }

    /**
     * すでにセッション保存された不正解だった問題の番号の配列から、
     * POSTで受け取った問題番号の配列と重複している要素を削除する。
     */
    public function deleteIncorrectProblems() {
        $this->set('incorrect', array_values(array_diff($this->get('incorrect'), json_decode($_POST['incorrect']))));
    }

    /**
     * すでにセッション保存された選択して保存された問題の番号の配列から、
     * POSTで受け取った問題番号の配列と重複している要素を削除する。
     */
    public function deleteSelectedProblems() {
        $this->set('selected', array_values(array_diff($this->get('selected'), json_decode($_POST['selected']))));
    }

    /**
     * POSTで受け取った、不正解だった問題の番号の配列をセッションに上書き保存する。
     */
    public function saveIncorrectProblems() {
        $this->set('incorrect', array_values(array_unique(array_merge(
            json_decode($_POST['incorrect']),
            (isset($_SESSION['incorrect'])) ? $_SESSION['incorrect'] : array()
        ))));
    }

    /**
     * POSTで受け取った、選択して保存された問題の番号の配列をセッションに上書き保存する。
     */
    public function saveSelectedProblems() {
        $this->set('selected', array_values(array_unique(array_merge(
            json_decode($_POST['selected']),
            (isset($_SESSION['selected'])) ? $_SESSION['selected'] : array()
        ))));
    }
}
