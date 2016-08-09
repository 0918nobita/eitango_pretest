<?php
namespace Pretest\Models;

/**
 * Validator クラス
 * 入力値検証を行い、不正なら場合によってはエラーページに飛ばす
 * 正しければ単なる値として返す
 * @access public
 * @author 0918nobita
 * @package Pretest\Models
 */

class Validator
{
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

    public function checkQuantity($first, $last, $quantity, $order) {
        if (($order == "rnd") && ($quantity != 0) && ($quantity < $last - $first + 1)) {
            return $quantity;
        } else {
            return $last - $first + 1;
        }
    }

    public function checkRange($first, $last, $max) {
        if ($first < 1 || $last > $max || $first > $last) header("location: ./?controller=error");
        return array($first, $last);
    }
}
