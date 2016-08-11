<?php
namespace Pretest\Models;

/**
 * PretestModel クラス
 * プレテスト画面で使用する英単語データをデータベースから取得し連想配列に整形してPretestControllerに返す。
 * @author 0918nobita
 * @package Pretest\Models
 */

class PretestModel extends Model
{
    public $max;

    const NUM = 0; // 番号順
    const RND = 1; // ランダム

    public function __construct()
    {
        parent::__construct();
        try {
            $stmt = $this->db->query("SELECT MAX(id) as id_max FROM words");
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $this->max = $result["id_max"];
    }
    
    public function getWords($first, $last, $order, $quantity=0) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM words WHERE id >= :first AND id <= :last");
            $stmt->bindValue(":first", $first);
            $stmt->bindValue(":last", $last);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        if ($order == PretestModel::RND) {
            shuffle($result);
            if ($quantity) $result = array_splice($result, 0, $quantity);
        }
        return $result;
    }
}
