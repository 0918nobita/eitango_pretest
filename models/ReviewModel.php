<?php
namespace Pretest\Models;

/**
 * ReviewModel クラス
 * 復習ページを表示する際に呼び出される、セッション保存された単語番号の配列をもとに
 * データベースから単語の情報(番号、英単語、意味)を取得して返すメソッドを実装している。
 * @author 0918nobita
 * @package Pretest\Models
 */

class ReviewModel extends Model
{
    public function getSelectedWords($array) {
        if (count($array) == 0) return array();
        try {
            $inClause = substr(str_repeat(',?', count($array)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT * FROM words WHERE id in (%s)', $inClause));
            $stmt->execute($array);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }
}
