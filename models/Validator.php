<?php
namespace Pretest\Models;

/**
 * Validator クラス
 * 入力値検証を行い、不正なら場合によってはエラーページに飛ばす
 * @access public
 * @author 0918nobita
 * @package Pretest\Models
 */

class Validator
{
    public function checkRange($first, $last, $max) {
        if ($first < 1 || $last > $max) {
            header("location: ./?controller=error");
        }
    }
}
