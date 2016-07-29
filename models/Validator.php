<?php
namespace Pretest\Models;

/**
 * Validator クラス
 * 入力値検証クラス。コントローラから渡された入力値が条件を満たしていれば単なる値として返すメソッドを実装する。
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
