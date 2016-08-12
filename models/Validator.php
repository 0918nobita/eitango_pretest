<?php
namespace Pretest\Models;

/**
 * Validator クラス
 * 入力値検証を行い、不正なら場合によってはエラーページに飛ばし、
 * 正しければ単なる値として返す。
 * @author 0918nobita
 * @package Pretest\Models
 */

class Validator
{
    /**
     * 解答方法と出題方法が正しく選択されているか検証する。
     * 不正ならエラーページに飛ばす。
     * @param string $answer_method 解答方法 ("touch" or "type")
     * @param string $method 出題方法 ("eitango-imi" or "imi-eitango")
     * @return array [解答方法, 出題方法]
     */
    public function checkMethod($answer_method, $method) {
        switch ($answer_method) {
            case "touch":
            case "type":
                break;
            default:
                header("location: ./?controller=error");
                break;
        }
        switch ($method) {
            case "eitango-imi":
            case "imi-eitango":
                break;
            default:
                header("location: ./?controller=error");
                break;
        }
        return array($answer_method, $method);
    }

    /**
     * 出題順序が正しく選択されているか検証する。
     * 不正ならエラーページに飛ばす。
     * @param string $order 出題順序 ("num" or "rnd")
     * @return string 出題順序
     */
    public function checkOrder($order) {
        switch ($order) {
            case "num":
            case "rnd":
                break;
            default:
                header("location: ./?controller=error");
                break;
        }
        return $order;
    }

    /**
     * 出題数が正しく入力されているか検証する。
     * 指定された範囲に存在する英単語の個数より大きい数で出題数が指定されていたら、
     * その範囲に存在する英単語すべてを出題するように出題数を修正する。
     * @param int $first 範囲(始点)
     * @param int $last 範囲(終点)
     * @param int $quantity 出題数
     * @param string $order 出題順序 ("num" or "rnd")
     * @return int 出題数
     */
    public function checkQuantity($first, $last, $quantity, $order) {
        if (($order == "rnd") && ($quantity != 0) && ($quantity < $last - $first + 1)) {
            return $quantity;
        } else {
            return $last - $first + 1;
        }
    }

    /**
     * 出題範囲が正しく入力されているか検証する。
     * 不正ならエラーページに飛ばす。(通常は設定画面のJavaScriptによってこのエラーは防がれるはず)
     * @param int $first 範囲(始点)
     * @param int $last 範囲(終点)
     * @param int $max 英単語idの最大値
     * @return array [始点, 終点]
     */
    public function checkRange($first, $last, $max) {
        if ($first < 1 || $last > $max || $first > $last) header("location: ./?controller=error");
        return array($first, $last);
    }
}
