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
    public function checkRange($first, $last, $max) {
        if ($first < 1 || $last > $max || $first > $last) header("location: ./?controller=error");
        return array($first, $last);
    }
}
